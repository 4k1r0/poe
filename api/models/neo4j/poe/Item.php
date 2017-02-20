<?php

namespace POE;

use Doctrine\Common\Collections\ArrayCollection;
use GraphAware\Neo4j\OGM\Annotations as OGM;


//  {"verified":false,"w":2,"h":4,"ilvl":71,"icon":"http:\/\/web.poecdn.com\/image\/Art\/2DItems\/Weapons\/TwoHandWeapons\/Bows\/SarkhamsReach.png?scale=1&w=2&h=4&v=f333c2e4005ee20a84270731baa5fa6a3","league":"Hardcore","id":"176b5e6f7af0a5bb4b48d7fdafa47501a179f4ea095815a58c82c4b5244b3cdb","sockets":[{"group":0,"attr":"D"}],"name":"<<set:MS>><<set:M>><<set:S>>Roth's Reach","typeLine":"Recurve Bow","identified":true,"corrupted":false,"lockedToCharacter":false,"note":"~price 10 exa","properties":[{"name":"Bow","values":[],"displayMode":0},{"name":"Quality","values":[["+17%",1]],"displayMode":0,"type":6},{"name":"Physical Damage","values":[["20-63",1]],"displayMode":0,"type":9},{"name":"Critical Strike Chance","values":[["6.50%",0]],"displayMode":0,"type":12},{"name":"Attacks per Second","values":[["1.31",1]],"displayMode":0,"type":13}],"requirements":[{"name":"Level","values":[["18",0]],"displayMode":0},{"name":"Dex","values":[["65",0]],"displayMode":1}],"explicitMods":["68% increased Physical Damage","34% increased Elemental Damage with Weapons","5% increased Attack Speed","Skills Chain +1 times","30% increased Projectile Speed"],"flavourText":["\"Exiled to the sea; what a joke. \r","I'm more free than I've ever been.\"\r","- Captain Weylam \"Rot-tooth\" Roth of the Black Crest"],"frameType":3,"x":10,"y":0,"inventoryId":"Stash1","socketedItems":[]}

// {"verified":false,"w":1,"h":1,"ilvl":0,"icon":"http:\/\/web.poecdn.com\/image\/Art\/2DItems\/Gems\/Support\/AddedLightningDamage.png?scale=1&w=1&h=1&v=9228c011d886459c66e66caa1d3e6fb13","support":true,"league":"Standard","id":"cfd6dff3e9617dbe3c3056fec09f6caa42608d1bec1d07b3ea25c11cc1133939","sockets":[],"name":"","typeLine":"Added Lightning Damage Support","identified":true,"corrupted":false,"lockedToCharacter":false,"properties":[{"name":"Lightning, Support","values":[],"displayMode":0},{"name":"Level","values":[["9",0]],"displayMode":0,"type":5},{"name":"Mana Multiplier","values":[["130%",0]],"displayMode":0}],"additionalProperties":[{"name":"Experience","values":[["163228\/554379",0]],"displayMode":2,"progress":0.294433951378}

/**
 * @OGM\Node(label="Item")
 */
class Item extends PoeApiObject
{
    /**
     * @OGM\GraphId()
     * @var int
     */
    protected $id;
    
    /**
     * @OGM\Property(type="boolean")
     * @var boolean
     */
    public $verified;
    
    /**
     * @OGM\Property(type="int")
     * @var int
     */
    public $w;
    
    /**
     * @OGM\Property(type="int")
     * @var int
     */
    public $h;
    
    /**
     * @OGM\Property(type="int")
     * @var int
     */
    public $ilvl;
    
    /**
     * @OGM\Property(type="string")
     * @var string
     */
    public $icon;
    
    /**
     * @OGM\Property(type="string")
     * @var string
     */
    public $league;
    
    /**
     * @OGM\Property(type="string")
     * @var string
     */
    public $uid;
    
    /**
     * @OGM\Property(type="string")
     * @var string
     */
    public $name;
    
    /**
     * @OGM\Property(type="string")
     * @var string
     */
    public $typeline;
    
    /**
     * @OGM\Property(type="boolean")
     * @var boolean
     */
    public $identified;
    
    /**
     * @OGM\Property(type="boolean")
     * @var boolean
     */
    public $corrupted;
    
    /**
     * @OGM\Property(type="boolean")
     * @var boolean
     */
    public $lockedToCharacter;
    
    /**
     * @OGM\Property(type="string")
     * @var string
     */
    public $note;
    
    /**
     * @OGM\Relationship(type="HAS_PROPERTIES", direction="OUTGOING", targetEntity="Property", collection=true)
     * @var ArrayCollection|Property[]
     */
    public $properties;
    
    /**
     * @OGM\Relationship(type="REQUIRE", direction="OUTGOING", targetEntity="Property", collection=true)
     * @var ArrayCollection|Property[]
     */
    public $requirements;
    
    /**
     * @OGM\Property(type="string")
     * @var string
     */
    public $flavourText;
    
    /**
     * @OGM\Property(type="string")
     * @var string
     */
    public $inventoryId;
    
    /**
     * @OGM\Property(type="int")
     * @var int
     */
    public $frameType;
    
    /**
     * @OGM\Property(type="int")
     * @var int
     */
    public $x;
    
    /**
     * @OGM\Property(type="int")
     * @var int
     */
    public $y;
    
    /**
     * @OGM\Relationship(type="SOCKETED_WITH", direction="OUTGOING", targetEntity="Item", collection=true)
     * @var ArrayCollection|Item[]
     */
    public $socketedItems;
    
    /**
     * @param string $next_change_id
     * @param int $page
     */
    public function __construct()
    {
        $this->properties = new ArrayCollection();
        $this->requirements = new ArrayCollection();
        $this->socketedItems = new ArrayCollection();
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param \POE\Property $property
     */
    public function addProperty(Property $property)
    {
        if (!$this->properties->contains($property)) {
            $this->properties->add($property);
        }
        return $this;
    }
    
    /**
     * @param \POE\Property $property
     */
    public function removeProperty(Property $property)
    {
        if ($this->properties->contains($property)) {
            $this->properties->removeElement($property);
        }
        return $this;
    }
    
    /**
     * @param \POE\Property $requirement
     */
    public function addRequirement(Property $requirement)
    {
        if (!$this->requirements->contains($requirement)) {
            $this->requirements->add($requirement);
        }
        return $this;
    }
    
    /**
     * @param \POE\Property $property
     */
    public function removeRequirement(Property $requirement)
    {
        if ($this->requirements->contains($requirement)) {
            $this->requirements->removeElement($requirement);
        }
        return $this;
    }
    
    /**
     * @param \POE\SocketedItem $socketedItem
     */
    public function addSockedtedItem(SockedtedItem $socketedItem)
    {
        if (!$this->socketedItems->contains($socketedItem)) {
            $this->socketedItems->add($socketedItem);
        }
        return $this;
    }
    
    /**
     * @param \POE\SocketedItem $socketedItem
     */
    public function removeSockedtedItem(SockedtedItem $socketedItem)
    {
        if ($this->socketedItems->contains($socketedItem)) {
            $this->socketedItems->removeElement($socketedItem);
        }
        return $this;
    }
}