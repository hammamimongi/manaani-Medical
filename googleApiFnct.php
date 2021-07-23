<?php
/*
// intégration d'autoloader
require_once __DIR__.'/vendor/autoload.php';
$analytics= initializeAnalutics();
$profile=getFirstProfilId($analytics);
var_dump($profile); die();

// fonction d'initialisation
function initializeAnalutics(){
    // chemin fichier json
    $key_file_location= __DIR__ . '/proven-center-285715-7db94e22ae1a.json';
    // creation et configuration du client
    $client = new Google_Client();
    $client->setApplicationName('Hello Analytics Reporting');
    $client->setAuthConfig($key_file_location);
    $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
    $analytics = new Google_Service_Analytics($client);
    return $analytics;
}

// Recupération du profil google Analytics
function getFirstProfilId($analytics){
    // liste des compte

    $accounts = $analytics->management_accounts->listManagementAccounts();
    if(count($accounts->getItems())>0){
        $items=$accounts->getItems();
        $firstAccountId = $items[0]->getId();

        $properties=
            $analytics->management_webproperties->listManagementWebproperties($firstAccountId);
        if(count($properties->getItems())>0){
            $items=$properties->getItems();
            $firstPropertybyId=$items[0]->getId();

            $profiles=$analytics->management_profiles->listManagementpProfiles($firstAccountId,$firstPropertybyId);
            if(count($profiles->getItems())>0){
                $items=$profiles->getItems();
                return $items[0]->getId();
            }
            else{
                throw  new Exception("no views profile");
            }
        }
        else{
            throw  new Exception("no properties for user");
        }
    }
    else{
        throw  new Exception("no accounts found");
    }
}

function getResult($analytics,$profileId,$metric,$begin,$end){
    return $analytics->get_ga-get(
        'ga:'.$profileId,
            $begin,
            $end,
            'ga:'.$metric
        );
}
function printResults($result){
    if(count($result->getRows())>0) {
        $rows = $result->getRows();
        $valeur = $rows[0][0];
        return $valeur;
        }
    else{
        return "pas de resultat";
    }

}
$result = getResult($analytics,$profile,'users','30daysAdo','today');
echo '<pre>';
var_dump($result);
echo'</pre>';