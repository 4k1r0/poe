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
                
                
                
                {"verified":false,"w":2,"h":4,"ilvl":71,"icon":"http:\/\/web.poecdn.com\/image\/Art\/2DItems\/Weapons\/TwoHandWeapons\/Bows\/SarkhamsReach.png?scale=1&w=2&h=4&v=f333c2e4005ee20a84270731baa5fa6a3","league":"Hardcore","id":"176b5e6f7af0a5bb4b48d7fdafa47501a179f4ea095815a58c82c4b5244b3cdb","sockets":[{"group":0,"attr":"D"}],"name":"<<set:MS>><<set:M>><<set:S>>Roth's Reach","typeLine":"Recurve Bow","identified":true,"corrupted":false,"lockedToCharacter":false,"note":"~price 10 exa","properties":[{"name":"Bow","values":[],"displayMode":0},{"name":"Quality","values":[["+17%",1]],"displayMode":0,"type":6},{"name":"Physical Damage","values":[["20-63",1]],"displayMode":0,"type":9},{"name":"Critical Strike Chance","values":[["6.50%",0]],"displayMode":0,"type":12},{"name":"Attacks per Second","values":[["1.31",1]],"displayMode":0,"type":13}],"requirements":[{"name":"Level","values":[["18",0]],"displayMode":0},{"name":"Dex","values":[["65",0]],"displayMode":1}],"explicitMods":["68% increased Physical Damage","34% increased Elemental Damage with Weapons","5% increased Attack Speed","Skills Chain +1 times","30% increased Projectile Speed"],"flavourText":["\"Exiled to the sea; what a joke. \r","I'm more free than I've ever been.\"\r","- Captain Weylam \"Rot-tooth\" Roth of the Black Crest"],"frameType":3,"x":10,"y":0,"inventoryId":"Stash1","socketedItems":[]}
            
                
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