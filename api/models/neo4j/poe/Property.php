<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 11/02/2017
 * Time: 21:20
 */

namespace POE;

use Doctrine\Common\Collections\ArrayCollection;
use GraphAware\Neo4j\OGM\Annotations as OGM;

// {"name":"Bow","values":[],"displayMode":0},{"name":"Quality","values":[["+17%",1]],"displayMode":0,"type":6},{"name":"Physical Damage","values":[["20-63",1]],"displayMode":0,"type":9},{"name":"Critical Strike Chance","values":[["6.50%",0]],"displayMode":0,"type":12},{"name":"Attacks per Second","values":[["1.31",1]],"displayMode":0,"type":13}


/**
 * @OGM\Node(label="Property")
 */
class Property extends PoeApiObject
{
    /**
     * @OGM\GraphId()
     * @var int
     */
    protected $id;
    
    /**
     * @OGM\Property(type="string")
     * @var string
     */
    public $name;
    
    /**
     * @OGM\Property(type="array")
     * @var array
     */
    public $values;
    
    /**
     * @OGM\Property(type="int")
     * @var int
     */
    public $displayMode;
    
    /**
     * @OGM\Property(type="int")
     * @var int
     */
    public $type;
    
    /**
     * @OGM\Property(type="float")
     * @var float
     */
    public $progress;
    
}