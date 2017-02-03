<?php

require_once 'NextChangeId.php';
require_once 'Stash.php';

/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 03/02/2017
 * Time: 00:21
 */
class Neo4jObject
{
    static $jsonLabelToObj = [
        'next_change_id'        => 'NextChangeId',
        'stashes'               => 'Stash',
        'items'                 => 'Item',
        'sockets'               => 'Socket',
        'requirements'          => 'Requirement',
        'properties'            => 'Property',
        'additionalProperties'  => 'AdditionalProperty',
        'nextLevelRequirements' => 'NextLevelRequirement',
        'values'                => 'Value',
    ];
    
    protected $_label;
    protected $_class;
    
    
    static function create( $label = '' )
    {
        if ( isset(self::$jsonLabelToObj[ $label ]) && class_exists(self::$jsonLabelToObj[ $label ]) ) {
            return new self::$jsonLabelToObj[ $label ]($label);
        }
        else {
            return new self($label);
        }
    }
    
    public function __construct( $label = '' )
    {
        $this->_label = $label;
        $this->_class = self::$jsonLabelToObj[ $label ];
    }
    
    public function loadFromObject( $oObject )
    {
        foreach ( $oObject as $attr => $mValue ) {
            
            if ( is_array($mValue) && isset(self::$jsonLabelToObj[ $attr ]) ) {
                $this->$attr = [];
                foreach ( $mValue as $oChildObject ) {
                    $this->{$attr}[] = self::create($attr)->loadFromObject($oChildObject);
                }
            }
            else {
                $this->$attr = $mValue;
            }
            
        }
        
        return $this;
    }
    
    public function toCypher()
    {
        $aMerge = [
            $this->getMergeQuery(),
            $this->getMergeData(),
        ];
        var_dump($aMerge);
        
        foreach ($this as $attr => $value){
            if( is_array($value) ){
                foreach ( $value as $index => $child ){
                    
                    if( is_object($child) && isset(class_parents($child)[get_class()]) ){
                        $child->toCypher();
                    }
                }
            }
        }
    }
    
    protected function getMergeQuery()
    {
        $sMerge = 'MERGE (' . $this->_label . ':' . $this->_class;
        
        if ( isset($this->id) ) {
            $sMerge .= ' {id: {id}} ON CREATE SET ' . $this->_label . ' += {datas}';
        }
        else {
            $sMerge .= ' {datas}';
        }
        $sMerge .= ')';
        
        return $sMerge;
    }
    
    protected function getMergeData(){
        $aData = [
            'datas'=>[]
        ];
        
        if ( isset($this->id) ) {
            $aData['id'] = $this->id ;
        }
        
        foreach ( $this as $attr => $value ) {
            if ( substr($attr, 0, 1) !== '_' && !is_array($value) ) {
                $aData['datas'][ $attr ] = $value;
            }
        }
        return $aData;
    }
}