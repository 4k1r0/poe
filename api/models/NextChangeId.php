<?php

/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 03/02/2017
 * Time: 01:20
 */
class NextChangeId extends Neo4jObject
{
    protected function getMergeQuery()
    {
       return <<<EOQ
MATCH (nci:NextChangeId)
WITH count(nci) as nbNci
MERGE ('.$this->_label.':'.$this->_class.' {id: {id}})
ON CREATE SET '.$this->_label.'.page += nbNci+1';
EOQ;
    }
    
    protected function getMergeData(){
        return [
                'id' => $this->next_change_id
        ];
    }
}
