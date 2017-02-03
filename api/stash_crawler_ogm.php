<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 03/02/2017
 * Time: 02:14
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/models/Neo4j/poe/NextChangeId.php';
require_once __DIR__ . '/models/Neo4j/poe/Stash.php';

use GraphAware\Neo4j\OGM\EntityManager;
use POE\NextChangeId;
use POE\Stash;

$manager = EntityManager::create('http://neo4j:matthieu@localhost:7474');

$nextChangeIdRepository = $manager->getRepository(NextChangeId::class);

$nci = $nextChangeIdRepository->findOneBy('next_change_id', '2300-4136-3306-4292-1278');
var_dump($nci);

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