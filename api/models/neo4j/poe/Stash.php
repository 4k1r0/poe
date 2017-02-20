<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 03/02/2017
 * Time: 02:22
 */

namespace POE;

use Doctrine\Common\Collections\ArrayCollection;
use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="Stash")
 */
class Stash extends PoeApiObject
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
    public $accountName;
    
     /**
     * @OGM\Property(type="string")
     * @var string
     */
    public $lastCharacterName;
    
     /**
     * @OGM\Property(type="string")
     * @var string
     */
    public $uid;
    
     /**
     * @OGM\Property(type="string")
     * @var string
     */
    public $stash;
    
     /**
     * @OGM\Property(type="string")
     * @var string
     */
    public $stashType;
    
    /**
     * @OGM\Property(type="string")
     * @var string
     */
    public $public;
    
    /**
     * @OGM\Relationship(type="CONTAIN_IN", direction="OUTGOING", targetEntity="Item", collection=true)
     * @var ArrayCollection|Item[]
     */
    public $items;
    
    /**
     * Stash constructor.
     *
     * @param string $accountName
     * @param string $lastCharacterName
     * @param string $uid
     * @param string $stash
     * @param string $stashType
     * @param bool   $public
     */
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param \POE\Item $item
     */
    public function addItem(Item $item)
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
        }
        return $this;
    }
    
    /**
     * @param \POE\Item $item
     */
    public function removeStash(Item $item)
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
        }
        return $this;
    }
}