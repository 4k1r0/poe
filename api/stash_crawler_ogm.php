<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 03/02/2017
 * Time: 02:14
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/models/Neo4j/poe/PoeApiObject.php';
require_once __DIR__ . '/models/Neo4j/poe/NextChangeId.php';
require_once __DIR__ . '/models/Neo4j/poe/Stash.php';
require_once __DIR__ . '/models/Neo4j/poe/Item.php';
require_once __DIR__ . '/models/Neo4j/poe/Property.php';

use GraphAware\Neo4j\OGM\EntityManager;
use POE\NextChangeId;

$manager = EntityManager::create('http://neo4j:matthieu@localhost:7474');

try {
    $nextChangeIdRepository = $manager->getRepository(NextChangeId::class);
    
    $nci = $nextChangeIdRepository->findBy('next_change_id', '4444-4444-4444-4444-4444');
    var_dump($nci);
}
catch ( Exception $e ) {
    echo $e->getMessage();
}

crawl($manager);

function crawl( EntityManager $noe4jManager, $id = 0, &$count = 1 )
{
    //$oData = json_decode(file_get_contents("http://api.pathofexile.com/public-stash-tabs?id=" . $id));
    $oData = json_decode(file_get_contents("http://poe/api/test.json?id=" . $id));
    
    $count = 0;
    while ( $count < 20 && isset($oData->stashes[ $count ]) ) { // max ~80
        
        $oStash = POE\Stash::create()->hydrateFromObject($oData->stashes[ $count ]);
        
        $noe4jManager->persist($oStash);
        
        try {
            $noe4jManager->flush();
        }
        catch ( Exception $e ) {
            echo $e->getMessage();
        }
        $noe4jManager->clear();
        ++$count;
    }
    //$nci = POE\NextChangeId::create()->hydrateFromObject($oData);
    
    //echo '<pre>';
    //print_r($nci);
    
    //$noe4jManager->persist($nci);
    
}

/*
$s1 = new Stash(
    '4k1r0',
    'superWitch',
    'a9a42a5dbda657f71b077ecd0692acce8d1d29c7dff3437e5ed8708f6cb8838f',
    'LEVELING UNIQUES',
    'PremiumStash',
    false
);


$s2 = new Stash(
    'Nightlines',
    'ProbablyTotem',
    'a9a42a5dbda657f71b077ecd0692acce8d1d29c7dff3437e5ed8708f6cb8838f',
    'LEVELING UNIQUES',
    'PremiumStash',
    false
);

$nci = new NextChangeId('4444-4444-4444-4444-4444', 2);
$nci->addStash($s1);
$nci->addStash($s2);
$manager->persist($nci);
$manager->flush();
*/