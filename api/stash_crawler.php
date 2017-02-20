<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 01/02/2017
 * Time: 23:06
 */

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/models/Neo4jObject.php';
require_once __DIR__ . '/models/Neo4j/poe/NextChangeId.php';

use GraphAware\Neo4j\Client as Db;

$client = Db\ClientBuilder::create()
    ->addConnection('default', 'http://neo4j:matthieu@localhost:7474')
    ->build();

$query = "MATCH (n:NextChangeId)
          WITH MAX(n.page) as maxPage
          MATCH (nci:NextChangeId)
          WHERE nci.page = maxPage
          RETURN nci.id, nci.page";

try {
    $result = $client->run($query);
    $record = $result->getRecord();
    $nLastId = $record->value('nci.id');
    echo "Start a partir de $nLastId - page " . $record->value('nci.page') . "<br/>";
}
catch ( RuntimeException $e ) {
    echo 'Start a partir de 0<br/>';
    $nLastId = 0;
}

getStash($client, $nLastId);

echo 'end';

function getStash( Db\Client $db_client, $id = 0, &$count = 1 )
{
    $oData = json_decode(file_get_contents("http://api.pathofexile.com/public-stash-tabs?id=" . $id));
    
    $stack = $db_client->stack();
    
    $stack->push(
        'MATCH (nci:NextChangeId)
                WITH count(nci) as nbNci
                MERGE (n:NextChangeId {next_change_id: {id}})
                ON CREATE SET n.page = nbNci+1',
        [
            'id' => $oData->next_change_id
        ]
    );
    
    
    $o = Neo4jObject::create('next_change_id')->loadFromObject($oData);
    echo '<pre>';
    $o->toCypher();
    echo '</pre>';
    
    if ( is_array($oData->stashes) ) {
        foreach ( $oData->stashes as $oStash ) {
            /*
            foreach( $oStash->item as $oItem ){
                
                $queryItem = 'MERGE(item:Item {})';
                
                
                
               
            
                
            }
            
            $stack->push(
                'MERGE (s:Stash {id: {stashid}})
                        ON CREATE SET s += {data}',
                [
                    "stashid" => $oStash->id,
                    'data'    => [
                        'accountName'       => $oStash->accountName,
                        'lastCharacterName' => $oStash->lastCharacterName,
                        'id'                => $oStash->id,
                        'stashName'         => $oStash->stash,
                        'stashType'         => $oStash->stashType,
                        'public'            => $oStash->public,
                    ],
                ]
            );
    */
        }
    }
    
    $db_client->runStack($stack);
    
    
    $nextId = $oData->next_change_id;
    unset($oData);
    
    if ( !empty($nextId) && $count < 1 ) {
        echo 'page suivante<br/>';
        sleep(1);
        ++$count;
        getStash($db_client, $nextId, $count);
    }
    
    echo $count . '-';
}