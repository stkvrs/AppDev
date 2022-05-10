<?php

session_start();

use GuzzleHttp\Client;

function storeSummary() {
    // Store the Countries summary in mongo DB
    require_once $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";

    $client = new Client(['verify' => false,'base_uri' => $_ENV["API_URL"]]);

    $response = $client->request('GET', 'summary');

    $summary = json_decode($response->getBody());

    $collection_summary = $db->country_summary;

    $collection_summary->deleteMany([]);

    $collection_summary->insertOne($summary);
}

function getSummary() {
    // Get Countries summary from mongo DB
    require $_SERVER['DOCUMENT_ROOT'] . "/vendor/autoload.php";
    require $_SERVER['DOCUMENT_ROOT'] . "/config.php";

    $collection_summary = $db->country_summary;
    $country_selected = $collection_summary->find([]);

    foreach ($country_selected as $document) {
        $countries_summary = [
            "Global" => $document['Global']['TotalConfirmed'],
            "Countries" => $document['Countries']
        ];
        
        return $countries_summary;
        // echo "<pre>"; print_r($document);
    }
}

 