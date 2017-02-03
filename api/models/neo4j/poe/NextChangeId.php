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
class NextChangeId
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
    protected $next_change_id;
    
    /**
     * @OGM\Property(type="int")
     * @var int
     */
    protected $page;
    
    /**
     * @OGM\Relationship(type="CONTAIN_IN", direction="OUTGOING", targetEntity="Stash", collection=true)
     * @var ArrayCollection|Stash[]
     */
    protected $stashes;
    
    /**
     * @param string $next_change_id
     * @param int $page
     */
    public function __construct($next_change_id, $page = 0)
    {
        $this->next_change_id = $next_change_id;
        $this->page = $page;
        $this->stashes = new ArrayCollection();
    }
    
    // Getters and Setters
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getNextCHangeId()
    {
        return $this->next_change_id;
    }
    
    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }
    
    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|Stash[]
     */
    public function getStashes()
    {
        return $this->stashes;
    }
    
    /**
     * @param string $next_change_id
     */
    public function setNextChangeId($next_change_id)
    {
        $this->next_change_id = $next_change_id;
    }
    
    /**
     * @param int $next_change_id
     */
    public function setPage($page)
    {
        $this->page = $page;
    }
    
    /**
     * @param \POE\Stash $stash
     */
    public function addStash(Stash $stash)
    {
        if (!$this->stashes->contains($stash)) {
            $this->stashes->add($stash);
        }
    }
    
    /**
     * @param \POE\Stash $stash
     */
    public function removeStash(Stash $stash)
    {
        if ($this->stashes->contains($stash)) {
            $this->stashes->removeElement($stash);
        }
    }
}