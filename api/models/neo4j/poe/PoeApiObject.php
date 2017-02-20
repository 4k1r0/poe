<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 11/02/2017
 * Time: 19:37
 */

namespace POE;

abstract class PoeApiObject
{
    protected $map = [
        'stashes'               => 'Stash',
        'items'                 => 'Item',
        'socketedItems'         => 'Item',
        'properties'            => 'Property',
        'requirements'          => 'Property',
        'additionalProperties'  => 'Property',
        'nextLevelRequirements' => 'Property',
    ];
    
    public function hydrateFromObject( \stdClass $object )
    {
        foreach ( $object as $attr => $value ) {
            
            $this->$attr = null;
            
            if ( is_array($value) ) {
                $this->hydrateFromArray($attr, $value);
            }
            elseif ( is_object($value) ) {
                $classLoader = $this->getPhpClass($attr);
                $this->$attr = class_exists($classLoader)
                    ? $classLoader::create()->hydrateFromObject($value)
                    : $value;
            }
            else {
                $this->$attr = $value;
            }
        }
        
        return $this;
    }
    
    protected function hydrateFromArray( $attr, array $array )
    {
        foreach ( $array as $value ) {
            
            if ( is_array($value) ) {
                $this->hydrateFromArray($attr, $value);
            }
            elseif ( is_object($value) ) {
                $classLoader = $this->getPhpClass($attr);
                $this->{$attr}[] = class_exists($classLoader)
                    ? $classLoader::create()->hydrateFromObject($value)
                    : $value;
            }
            else {
                $this->{$attr}[] = (string)$value; // ! cast important for neo4j models
            }
        }
        
        return $this;
    }
    
    protected function getPhpClass( $attr )
    {
        if ( isset($this->map[ $attr ]) ) {
            return __NAMESPACE__ . '\\' . $this->map[ $attr ];
        }
        
        return $attr;
    }
    
    public static function create()
    {
        return new static();
    }
}