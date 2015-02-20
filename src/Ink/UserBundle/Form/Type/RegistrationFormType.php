<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ink\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder
            ->add('firstname_user', null, array('label' => 'form.firstname_user', 'translation_domain' => 'FOSUserBundle'))
            ->add('lastname_user', null, array('label' => 'form.lastname_user', 'translation_domain' => 'FOSUserBundle'))
            ->add('id_status', null, array('label' => 'form.id_status', 'translation_domain' => 'FOSUserBundle'))
            ->add('description_user',null, array('label' => 'form.description_user', 'translation_domain' => 'FOSUserBundle'))
            ->add('birthday_user',null, array('label' => 'form.birthday_user', 'translation_domain' => 'FOSUserBundle'))
            ->add('city_user', null, array('label' => 'form.city_user', 'translation_domain' => 'FOSUserBundle'))
            ->add('postalcode_user', null, array('label' => 'form.postalcode_user', 'translation_domain' => 'FOSUserBundle'))
            ->add('street_user', null, array('label' => 'form.street_user', 'translation_domain' => 'FOSUserBundle'));

    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'ink_user_registration';
    }
}