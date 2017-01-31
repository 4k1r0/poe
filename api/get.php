<?php
/**
 * Created by PhpStorm.
 * User: matthieu
 * Date: 28/01/2017
 * Time: 21:18
 */

set_time_limit(0);

function getStash( $account, $id = 0, &$count = 1 )
{
    
    $oData = json_decode(file_get_contents("http://api.pathofexile.com/public-stash-tabs?id=".$id));
    
    if( is_array($oData->stashes) ){
        foreach( $oData->stashes as $oStash ) {
            
            if( $oStash->accountName == $account || $oStash->accountName == 'AlexanderseNbyQ' ){
                var_dump($oStash);
                return true;
            }
        }
    }
    $nextId = $oData->next_change_id;
    unset($oData);
    
    if( !empty($nextId) && $count < 10 ){
        echo 'page suivante<br/>';
        sleep(1);
        ++$count;
        getStash($account, $nextId, $count);
    }
    
    echo $count.'-';
}

getStash('4k1r0');