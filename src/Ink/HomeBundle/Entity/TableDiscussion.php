<?php

namespace Ink\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TableDiscussion
 *
 * @ORM\Table(name="table_discussion")
 * @ORM\Entity
 */
class TableDiscussion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_conversation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idConversation;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user1", type="integer", nullable=false)
     */
    private $idUser1;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_user2", type="integer", nullable=false)
     */
    private $idUser2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastMaj", type="datetime", nullable=false)
     */
    private $lastmaj = 'CURRENT_TIMESTAMP';



    /**
     * Get idConversation
     *
     * @return integer
     */
    public function getIdConversation()
    {
        return $this->idConversation;
    }

    /**
     * Set idUser1
     *
     * @param integer $idUser1
     * @return TableDiscussion
     */
    public function setIdUser1($idUser1)
    {
        $this->idUser1 = $idUser1;

        return $this;
    }

    /**
     * Get idUser1
     *
     * @return integer
     */
    public function getIdUser1()
    {
        return $this->idUser1;
    }

    /**
     * Set idUser2
     *
     * @param integer $idUser2
     * @return TableDiscussion
     */
    public function setIdUser2($idUser2)
    {
        $this->idUser2 = $idUser2;

        return $this;
    }

    /**
     * Get idUser2
     *
     * @return integer
     */
    public function getIdUser2()
    {
        return $this->idUser2;
    }

    /**
     * Set lastmaj
     *
     * @param \DateTime $lastmaj
     * @return TableDiscussion
     */
    public function setLastmaj($lastmaj)
    {
        $this->lastmaj = $lastmaj;

        return $this;
    }

    /**
     * Init lastmaj
     *
     * @param \DateTime $lastmaj
     * @return TableDiscussion
     */
    public function initLastmaj()
    {
        $this->lastmaj = new \DateTime();

        return $this;
    }

    /**
     * Get lastmaj
     *
     * @return \DateTime
     */
    public function getLastmaj()
    {
        return $this->lastmaj;
    }


}
