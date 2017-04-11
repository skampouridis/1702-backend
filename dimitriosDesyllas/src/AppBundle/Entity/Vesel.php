<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vessel",indexes={
 *  @ORM\Index(name="mmsi",columns={"mmsi"})
 * })
 */
class Vesel
{
    /**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO") 
     * @var integer
     */
    private $id;

    /**
     * @ORM\Column(type="integer",name="mmsi")
     * @var integer
     */
    private $mmsi;

    /**
     * @ORM\OneToMany(targetEntity="VesselMoveStatus",mappedBy="vesel")
     * @var \Doctrine\Common\Collections\Collection
     */
    private $veselMoveStatuses;

    /**
     * Constructor
     */
    public function __construct($mmsi)
    {
        $this->veselMoveStatuses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setMmsi($mmsi);
    }

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
     * Set mmsi
     *
     * @param integer $mmsi
     *
     * @return Vesel
     */
    public function setMmsi($mmsi)
    {
        $this->mmsi = $mmsi;

        return $this;
    }

    /**
     * Get mmsi
     *
     * @return integer
     */
    public function getMmsi()
    {
        return $this->mmsi;
    }

    /**
     * Add veselMoveStatus
     *
     * @param \AppBundle\Entity\VesselMoveStatus $veselMoveStatus
     *
     * @return Vesel
     */
    public function addVeselMoveStatus(\AppBundle\Entity\VesselMoveStatus $veselMoveStatus)
    {
        $this->veselMoveStatuses[] = $veselMoveStatus;

        return $this;
    }

    /**
     * Remove veselMoveStatus
     *
     * @param \AppBundle\Entity\VesselMoveStatus $veselMoveStatus
     */
    public function removeVeselMoveStatus(\AppBundle\Entity\VesselMoveStatus $veselMoveStatus)
    {
        $this->veselMoveStatuses->removeElement($veselMoveStatus);
    }

    /**
     * Get veselMoveStatuses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVeselMoveStatuses()
    {
        return $this->veselMoveStatuses;
    }
}

