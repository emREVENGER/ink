<?php

namespace Ink\HomeBundle\Controller;

use Ink\UserBundle\Entity\User;
use Ink\HomeBundle\Entity\Message;
use Ink\HomeBundle\Entity\TableDiscussion;
use Ink\HomeBundle\Entity\Picture;
use Ink\HomeBundle\Entity\Portfolio;
use Ink\HomeBundle\Entity\Picsinfolio;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('InkHomeBundle:Default:index.html.twig');
    }

    public function searchAction(Request $request)
    {
        $defaultData = array('description' => "" );
        $form = $this->createFormBuilder($defaultData)
        ->add('description', 'text', array(
            'attr' => array(
                'placeholder' => 'Entrez vos critères ...'),
            'label' => false,
            'constraints' => array(
                new NotBlank(),
                new Length(array('min' => 3)))))
        ->add('type', 'choice', array('choices' => array('model' => 'Modèle', 'pro' => 'Professionel'),
            'expanded' => true,
            'multiple' => false,
            'preferred_choices' => array('model'),
            'required' => true,
            'data' => 'model'))
        ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData();
            // $data is array
        }

        return $this->render('InkHomeBundle:Default:search.html.twig', array('form' => $form->createView()));
    }

    public function teamAction()
    {
        return $this->render('InkHomeBundle:Default:team.html.twig');
    }

    public function accountAction()
    {
        return $this->render('InkHomeBundle:Default:account.html.twig');
    }

    public function messageAction(Request $request)
    {
        $discussion = $this->listofDiscussion();
        $users = $this->listUser();
        $messages = null;
        if ($discussion != null)
            $messages = $this->listofMessagefromDiscussion($discussion[0]->getIdConversation());


        $defaultData = array();
        $form = $this->createFormBuilder($defaultData)
        ->setAction($this->generateUrl('ink_data_home_sendpage'))
        ->add('new', 'submit', array('label' => 'Nouveau Message'))
        ->getForm();

        return $this->render('InkHomeBundle:Default:message.html.twig',
            array(
                'id' => 1,
                'form' => $form->createView(),
                'discussion' =>  $discussion,
                'users' => $users,
                'messages' => $messages));
    }

    public function connectionAction()
    {
        return $this->render('InkHomeBundle:Default:connection.html.twig');
    }

    public function ajaxdiscussionAction()
    {
        $request = $this->container->get('request');

        $users = array();

        if($request->isXmlHttpRequest())
        {
            $id = $request->query->get('id');
            $em = $this->getDoctrine()->getManager();
            $query1 = $em->createQuery(
                'SELECT p
                FROM InkHomeBundle:TableDiscussion p
                WHERE
                p.idConversation = :idConversation'
                )->setParameter('idConversation', $id);
            $Discussion = $query1->getResult();

            $query2 = $em->createQuery(
                'SELECT p
                FROM InkHomeBundle:User p
                WHERE
                p.id = :idUser1
                OR
                p.id = :idUser2'
                )
            ->setParameter('idUser1', $Discussion[0]->getIdUser1())
            ->setParameter('idUser2', $Discussion[0]->getIdUser2());
            $users = $query2->getResult();

            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                'SELECT p
                FROM InkHomeBundle:Message p
                WHERE
                p.idDiscussion = :idDiscussion
                ORDER BY p.dateTime DESC'
                )->setParameter('idDiscussion', $id);
            $messages = $query->getResult();
        }
        return $this->container->get('templating')->renderResponse('InkHomeBundle:Default:discussion.html.twig', array('messages' => $messages, 'users' => $users));
    }

    public function sendAction(Request $request)
    {
        $infos = '';
        $defaultData = array('description' => "" );
        $form = $this->createFormBuilder($defaultData)
        ->add('user', 'text', array('required' => true, 'label' => 'Destinataire', 'attr' => array(
            'placeholder' => 'Destinataire')))
        ->add('content', 'textarea', array('required' => true, 'label' => 'Contenu', 'attr' => array(
            'placeholder' => 'Entrez votre message', 'row' => '10')))
        ->add('add', 'submit', array('label' => 'Envoyer'))
        ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $message = new Message();

            $repositoryU = $this->getDoctrine()->getRepository('InkUserBundle:User');
            $user = $repositoryU->findOneByName($form->get('user')->getData());
            if ($user == null)
            {
                $infos = 'Utilisateur inconnu';
                return $this->render('InkHomeBundle:Default:send.html.twig',
                    array(
                        'form' => $form->createView(),
                        'infos' => $infos));
            }
            $repositoryD = $this->getDoctrine()->getRepository('InkHomeBundle:TableDiscussion');
            $discussion = $repositoryD->findOneBy(array('idUser1' => $user->getId(), 'idUser2' => 1));
            if ($discussion == null)
            {
                $discussion = $repositoryD->findOneBy(array('idUser2' => $user->getId(), 'idUser1' => 1));
                if ($discussion == null)
                {
                    // add table conversation
                    $discussion = new TableDiscussion();
                    $discussion->setIdUser1(1);
                    $discussion->setIdUser2($user->getId());
                    $discussion->initLastMaj();
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($discussion);
                    $em->flush();
                    //$repositoryD = $this->getDoctrine()->getRepository('InkHomeBundle:TableDiscussion');
                    //$discussion = $repositoryD->findOneByIdUser1($user->getId());
                }
            }
            $message->setContent( $form->get('content')->getData());
            $message->setIdDiscussion($discussion->getIdConversation());
            $message->setIdSender(1);
            $message->setDateTime();
            $discussion->setLastMaj($message->getDateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->persist($discussion);
            $em->flush();
            $infos = 'Message envoyée';
            unset($form);
            $form = $this->createFormBuilder($defaultData)
            ->add('user', 'text', array('required' => true, 'label' => 'Destinataire', 'attr' => array(
                'placeholder' => 'Destinataire')))
            ->add('content', 'textarea', array('required' => true, 'label' => 'Contenu', 'attr' => array(
                'placeholder' => 'Entrez votre message', 'row' => '10')))
            ->add('add', 'submit', array('label' => 'Envoyer'))
            ->getForm();
        }
        return $this->render('InkHomeBundle:Default:send.html.twig',
            array(
                'form' => $form->createView(),
                'infos' => $infos));
    }

    /** --------------------------------------------------- **/
    /** --------------------------------------------------- **/
    /** --------------------------------------------------- **/
    /** --------------------------------------------------- **/
    /** --------------------------------------------------- **/

    private function addMessage()
    {
        $message = new Message();

        $message->setContent();
        $message->getIdDiscussion();
        $message->getIdSender();

        $em = $this->getDoctrine()->getManager();
        $em->persist($message);
        $em->flush();
    }

    private function findDiscussion($id1, $id2)
    {
        /**("
            SELECT
            *
            FROM
            discussion
            WHERE
            (id_user1 ="+$id1+" AND id_user2 = "+$id2+")
            OR
            (id_user1 ="+$id2+" AND id_user2 = "+$id1+")
            ");
        $discussion = findOne();
        if ($discussion == null)
        {}
            ("
                INSERT FROM
                discussion
                (id_user1, id_user2)
                TO ("+$id1+", "+$id2+")");
            $discussion = insert();
        }**/

    }

    private function updateDiscussion($id_discussion)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT
            p
            FROM
            InkHomeBundle:TableDiscussion p
            WHERE
            p.idConversation = :id_discussion
            ORDER BY
            p.lastmaj DESC')
        ->setParameter('id_discussion', $id_discussion);

        try {
            $discussion = $query->getSingleResult();
        }
        catch (\Doctrine\Orm\NoResultException $e)
        {

        }
    }

    private function listofDiscussion()
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM InkHomeBundle:TableDiscussion p
            WHERE
            p.idUser1 = :idUser
            OR
            p.idUser2 = :idUser
            ORDER BY p.lastmaj DESC'
            )->setParameter('idUser', '1');
        $Discussion = $query->getResult();

        return $Discussion;
    }

    private function listofMessagefromDiscussion($idDiscussion)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p
            FROM InkHomeBundle:Message p
            WHERE
            p.idDiscussion = :idDiscussion
            ORDER BY p.dateTime DESC'
            )->setParameter('idDiscussion', $idDiscussion);
        $messages = $query->getResult();

        return $messages;
    }

    private function listUser()
    {
        $repository = $this->getDoctrine()->getRepository('InkUserBundle:User');
        $User = $repository->findAll();

        return $User;
    }

    /** --------------------------------------------------- **/
    /** --------------------------------------------------- **/
    /** --------------------------------------------------- **/
    /** --------------------------------------------------- **/
    /** --------------------------------------------------- **/

    public function photoAction()
    {
        $repPic = $this->getDoctrine()->getRepository('InkHomeBundle:Picture');
        $user = $repPic->findOneByName('');
        $repFolio = $this->getDoctrine()->getRepository('InkHomeBundle:Portfolio');
        $user = $repFolio->findOneByName('');
        $repPicFolio = $this->getDoctrine()->getRepository('InkHomeBundle:Picsinfolio');
        $user = $repPicFolio->findOneByidPicture('');

        $pic = new Picture();
        $form = $this->createFormBuilder($pic)
        ->add('name')
        ->add('file')
        ->getForm();

        if ($this->getRequest()->isMethod('POST'))
        {
            $form->handleRequest($this->getRequest());
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                $em->persist($pic);
                $em->flush();

            }
        }
        return $this->render('InkHomeBundle:Default:photo.html.twig',
            array('form' => $form->createView()));
    }
}
