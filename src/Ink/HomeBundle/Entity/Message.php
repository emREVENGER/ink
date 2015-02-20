<?php

namespace Ink\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity
 */
class Message
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sender", type="integer", nullable=false)
     */
    private $idSender;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_discussion", type="integer", nullable=false)
     */
    private $idDiscussion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_time", type="datetime", nullable=false)
     */
    private $dateTime = 'CURRENT_TIMESTAMP';



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Message
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set idSender
     *
     * @param integer $idSender
     * @return Message
     */
    public function setIdSender($idSender)
    {
        $this->idSender = $idSender;

        return $this;
    }

    /**
     * Get idSender
     *
     * @return integer
     */
    public function getIdSender()
    {
        return $this->idSender;
    }

    /**
     * Set idDiscussion
     *
     * @param integer $idDiscussion
     * @return Message
     */
    public function setIdDiscussion($idDiscussion)
    {
        $this->idDiscussion = $idDiscussion;

        return $this;
    }

    /**
     * Get idDiscussion
     *
     * @return integer
     */
    public function getIdDiscussion()
    {
        return $this->idDiscussion;
    }

    /**
     * Set dateTime
     *
     * @param \DateTime $dateTime
     * @return Message
     */
    public function setDateTime()
    {
        $this->dateTime = new \DateTime();

        return $this;
    }

    /**
     * Get dateTime
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }
}
