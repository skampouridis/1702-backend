<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vesssel",indexes={
 * 	@ORM\Index(name="index_mmsi",columns={"mmsi"}),
 *  @ORM\Index(name="index_station",columns={"station"}),
 *  @ORM\Index(name="position",columns={"long","lat"})
 * })
 */
class VesselMoveStatus
{
	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO") 
	 */
	private $id=null;
	
	/**
	 * @ORM\Column(name="mmsi",type="integer")
	 * @var integer|null
	 */
	private $mmsi=null;
	
	/**
	 * @ORM\Column(name="station",type="integer")
	 * @var integer|null
	 */
	private $station=null;
	
	/**
	 * @ORM\Column(name="speed",type="intrger")
	 * @var integer|null
	 */
	private $speed=null;
	
	/**
	 * @ORM\Column(name="long",type="integer")
	 * @var integer|null
	 */
	private $logtitude=null;
	
	/**
	 * @ORM\Column(name="lat",type="integer")
	 * @var integer|null
	 */
	private $latitude=null;
	
	/**
	 * @ORM\Column(name="course",type="integer")
	 * @var integer|null
	 */
	private $course=null;
	
	/**
	 * @ORM\Column(name="heading",type="integer")
	 * @var integer|null
	 */
	private $heading=null;
	
	/**
	 * @ORM\Column(name="rotation",type="integer")
	 * @var integer|null
	 */
	private $rotation=null;
	
	/**
	 * @ORM\Column(name="timestamp",type="date")
	 * @var Datetime|null
	 */
	private $timesptamp=null;

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
     * @return VesselMoveStatus
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
     * Set station
     *
     * @param integer $station
     *
     * @return VesselMoveStatus
     */
    public function setStation($station)
    {
        $this->station = $station;

        return $this;
    }

    /**
     * Get station
     *
     * @return integer
     */
    public function getStation()
    {
        return $this->station;
    }

    /**
     * Set speed
     *
     * @param \intrger $speed
     *
     * @return VesselMoveStatus
     */
    public function setSpeed(\intrger $speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return \intrger
     */
    public function getSpeed()
    {
        return $this->speed/10;
    }

    /**
     * Set logtitude
     *
     * @param integer $logtitude
     *
     * @return VesselMoveStatus
     */
    public function setLogtitude($logtitude)
    {
        $this->logtitude = $logtitude;

        return $this;
    }

    /**
     * Get logtitude
     *
     * @return integer
     */
    public function getLogtitude()
    {
        return $this->logtitude;
    }

    /**
     * Set latitude
     *
     * @param integer $latitude
     *
     * @return VesselMoveStatus
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return integer
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set course
     *
     * @param integer $course
     *
     * @return VesselMoveStatus
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return integer
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set heading
     *
     * @param integer $heading
     *
     * @return VesselMoveStatus
     */
    public function setHeading($heading)
    {
        $this->heading = $heading;

        return $this;
    }

    /**
     * Get heading
     *
     * @return integer
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * Set rotation
     *
     * @param integer $rotation
     *
     * @return VesselMoveStatus
     */
    public function setRotation($rotation)
    {
        $this->rotation = $rotation;

        return $this;
    }

    /**
     * Get rotation
     *
     * @return integer
     */
    public function getRotation()
    {
        return $this->rotation;
    }

    /**
     * Set timesptamp
     *
     * @param \DateTime $timesptamp
     *
     * @return VesselMoveStatus
     */
    public function setTimesptamp(DateTime $timesptamp)
    {
        $this->timesptamp = $timesptamp;

        return $this;
    }

    /**
     * Get timesptamp
     *
     * @return \DateTime
     */
    public function getTimesptamp()
    {
        return $this->timesptamp;
    }
}
