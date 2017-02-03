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
class Stash
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
    protected $accountName;
    
     /**
     * @OGM\Property(type="string")
     * @var string
     */
    protected $lastCharacterName;
    
     /**
     * @OGM\Property(type="string")
     * @var string
     */
    protected $uid;
    
     /**
     * @OGM\Property(type="string")
     * @var string
     */
    protected $stash;
    
     /**
     * @OGM\Property(type="string")
     * @var string
     */
    protected $stashType;
    
    /**
     * @OGM\Property(type="boolean")
     * @var boolean
     */
    protected $public;
    
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
    public function __construct( $accountName, $lastCharacterName, $uid, $stash, $stashType, $public )
    {
        $this->accountName = $accountName;
        $this->lastCharacterName = $lastCharacterName;
        $this->uid = $uid;
        $this->stash = $stash;
        $this->stashType = $stashType;
        $this->public = $public;
    }
    
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
    public function getAccountName()
    {
        return $this->accountName;
    }
    
    /**
     * @param string $accountName
     */
    public function setAccountName( $accountName )
    {
        $this->accountName = $accountName;
    }
    
    /**
     * @return string
     */
    public function getLastCharacterName()
    {
        return $this->lastCharacterName;
    }
    
    /**
     * @param string $lastCharacterName
     */
    public function setLastCharacterName( $lastCharacterName )
    {
        $this->lastCharacterName = $lastCharacterName;
    }
    
    /**
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }
    
    /**
     * @param string $uid
     */
    public function setUid( $uid )
    {
        $this->uid = $uid;
    }
    
    /**
     * @return string
     */
    public function getStash()
    {
        return $this->stash;
    }
    
    /**
     * @param string $stash
     */
    public function setStash( $stash )
    {
        $this->stash = $stash;
    }
    
    /**
     * @return string
     */
    public function getStashType()
    {
        return $this->stashType;
    }
    
    /**
     * @param string $stashType
     */
    public function setStashType( $stashType )
    {
        $this->stashType = $stashType;
    }
    
    /**
     * @return bool
     */
    public function isPublic()
    {
        return $this->public;
    }
    
    /**
     * @param bool $public
     */
    public function setPublic( $public )
    {
        $this->public = $public;
    }
}