<?php

namespace Ink\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Picsinfolio
 *
 * @ORM\Table(name="picsinfolio")
 * @ORM\Entity
 */
class Picsinfolio
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
     * @var integer
     *
     * @ORM\Column(name="id_picture", type="integer", nullable=false)
     */
    private $idPicture;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_portfolio", type="integer", nullable=false)
     */
    private $idPortfolio;



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
     * Set idPicture
     *
     * @param integer $idPicture
     * @return Picsinfolio
     */
    public function setIdPicture($idPicture)
    {
        $this->idPicture = $idPicture;

        return $this;
    }

    /**
     * Get idPicture
     *
     * @return integer
     */
    public function getIdPicture()
    {
        return $this->idPicture;
    }

    /**
     * Set idPortfolio
     *
     * @param integer $idPortfolio
     * @return Picsinfolio
     */
    public function setIdPortfolio($idPortfolio)
    {
        $this->idPortfolio = $idPortfolio;

        return $this;
    }

    /**
     * Get idPortfolio
     *
     * @return integer
     */
    public function getIdPortfolio()
    {
        return $this->idPortfolio;
    }
}
