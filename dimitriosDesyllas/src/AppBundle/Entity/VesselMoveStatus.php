<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Vesel;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VeselRouteRepository")
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
	 * @ORM\Column(name="timestamp",type="datetime")
	 * @var Datetime|null
	 */
	private $timestamp=null;

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
			->setCourse($course)
			->setHeading($heading)
			->setRotation($rotation)
			->setTimestamp($timestamp);
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
    	$this->logtitude = $this->sanitizeGpsCoordinate($logtitude);

        return $this;
    }

    /**
     * Get logtitude
     *
     * @return float
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
    	$this->latitude = $this->sanitizeGpsCoordinate($latitude);

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
    	$latitude=$this->latitude;
    	return $latitude;
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
    public function setTimestamp($timesptamp)
    {
    	$this->timestamp =  date_create_from_format("Y-m-d H:i:s.u",$timesptamp);
        return $this;
    }

    /**
     * Get timesptamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
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
    
    /**
     * Sometimes a GPS Coordinate may have the following format:
     * 1,234532 if inserted as is then itn WONT be retreived correctly.
     * Please use this method to sanitize the gps coordinate on setter method.
     * 
     * @param string | float $coordinate
     * @return number
     */
    private function sanitizeGpsCoordinate($coordinate)
    {
    	if(is_string($coordinate))
    	{
    		$coordinate=str_replace(',','.',$coordinate);
    	}
    	
    	return (float)$coordinate;
    }
}
