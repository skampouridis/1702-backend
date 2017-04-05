<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Vesel;

/**
 * @ORM\Entity
 * @ORM\Table(name="vessel_position_status",indexes={
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
	 * @ORM\ManyToOne(targetEntity="Vesel",inversedBy="veselMoveStatuses")
	 * @ORM\JoinColumn(name="vesel_id", referencedColumnName="id")
	 * @var Vesel
	 */
	private $vesel=null;
	
	/**
	 * @ORM\Column(name="status",type="integer")
	 * @var integer|null
	 */
	private $status=null;
	
	/**
	 * @ORM\Column(name="speed",type="integer")
	 * @var integer|null
	 */
	private $speed=null;
	
	/**
	 * @ORM\Column(name="long",type="float")
	 * @var float|null
	 */
	private $logtitude=null;
	
	/**
	 * @ORM\Column(name="lat",type="float")
	 * @var float|null
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

	public function __construct(
			Vesel $vesel=null,
			$status=null,
			$speed=null,
			$long=null,
			$lat=null,
			$course=null,
			$heading=null,
			$rotation=null,
			$timestamp=null
	){
		$this->setVesel($vesel)
			->setStatus($status)
			->setSpeed($speed)
			->setLogtitude($long)
			->setLatitude($lat)
			->setHeading($heading)
			->setRotation($rotation)
			->setTimesptamp($timestamp);
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
     * 
     * @param integer $status
     * @return \AppBundle\Entity\VesselMoveStatus
     */
    public function setStatus($status)
    {
    	$this->status=$status;
    	return $this;
    }
    
    /**
     * 
     * @return \AppBundle\Entity\integer|NULL
     */
    public function getStatus()
    {
    	return $this->status;
    }

    /**
     * Set speed
     *
     * @param integer $speed
     *
     * @return VesselMoveStatus
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return float
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
     * @param string $timesptamp
     *
     * @return VesselMoveStatus
     */
    public function setTimesptamp($timesptamp)
    {
    	$this->timesptamp =  date_create_from_format("Y-m-d H:i:s.u",$timesptamp);

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

    /**
     * Set vesel
     *
     * @param \AppBundle\Entity\Vesel $vesel
     *
     * @return VesselMoveStatus
     */
    public function setVesel(\AppBundle\Entity\Vesel $vesel = null)
    {
        $this->vesel = $vesel;

        return $this;
    }

    /**
     * Get vesel
     *
     * @return \AppBundle\Entity\Vesel
     */
    public function getVesel()
    {
        return $this->vesel;
    }
}
