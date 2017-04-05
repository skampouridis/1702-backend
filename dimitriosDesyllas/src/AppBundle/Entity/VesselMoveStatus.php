<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vesssel",indexes={
 * 	@index(name='index_mmsi',columns={"mmsi"}),
 *  @index(name='index_station',columns={"station"}),
 *  @index(name='position',columns={long,lat})
 * })
 */
class VesselMoveStatus
{
	/**
	 * @ORM\Column(type='integer')
	 * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO") 
	 */
	private $id=null;
	
	/**
	 * @ORM\Column(name='mmsi',type='integer')
	 * @var integer|null
	 */
	private $mmsi=null;
	
	/**
	 * @ORM\Column(name='station',type='integer')
	 * @var integer|null
	 */
	private $station=null;
	
	/**
	 * @ORM\Column(name='speed',type='intrger')
	 * @var integer|null
	 */
	private $speed=null;
	
	/**
	 * @ORM\Column(name='long',type='integer')
	 * @var integer|null
	 */
	private $logtitude=null;
	
	/**
	 * @ORM\Column(name='lat',type='integer')
	 * @var integer|null
	 */
	private $latitude=null;
	
	/**
	 * @ORM\Column(name='course',type='integer')
	 * @var integer|null
	 */
	private $course=null;
	
	/**
	 * @ORM\Column(name='heading',type='integer')
	 * @var integer|null
	 */
	private $heading=null;
	
	/**
	 * @ORM\Column(name='rotation',type='integer')
	 * @var integer|null
	 */
	private $rotation=null;
	
	/**
	 * @ORM\Column(name='timestamp',type='date')
	 * @var Datetime|null
	 */
	private $rotation=null;
}