<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 03/02/2017
 * Time: 02:08
 */

namespace POE;

use Doctrine\Common\Collections\ArrayCollection;
use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="NextChangeId")
 */
class NextChangeId extends PoeApiObject
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
    public $next_change_id;
    
    /**
     * @OGM\Property(type="int")
     * @var int
     */
    public $page;
    
    /**
     * @OGM\Relationship(type="REFERENCE_IN", direction="OUTGOING", targetEntity="Stash", collection=true)
     * @var ArrayCollection|Stash[]
     */
    public $stashes;
    
    /**
     * @param string $next_change_id
     * @param int $page
     */
    public function __construct()
    {
        $this->stashes = new ArrayCollection();
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param \POE\Stash $stash
     */
    public function addStash(Stash $stash)
    {
        if (!$this->stashes->contains($stash)) {
            $this->stashes->add($stash);
        }
        return $this;
    }
    
    /**
     * @param \POE\Stash $stash
     */
    public function removeStash(Stash $stash)
    {
        if ($this->stashes->contains($stash)) {
            $this->stashes->removeElement($stash);
        }
        return $this;
    }
}