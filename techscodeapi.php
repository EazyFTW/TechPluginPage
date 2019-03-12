<?php

$apiUrl = get_theme_mod("api_url");
$apiToken = get_theme_mod("api_token");
$resourceId = get_theme_mod("resource_id");

$data = @file_get_contents($apiUrl."?token=".$apiToken);
$apiRunning = !empty($data);
$json = json_decode($data, true);

$apiRunning = $apiRunning && $json['status'] == "SUCCESS";

$reviews = array();
$purchases = array();
$resources = array();
$updates = array();

if($apiRunning){
  $dataObject = $json['data'];

  foreach($dataObject['reviews'] as $review){
    if($review['resourceId'] == $resourceId){
      array_push($reviews, $review);
    }
  }

  foreach($dataObject['purchases'] as $purchase){
    if($purchase['resourceId'] == $resourceId){
      array_push($purchases, $purchase);
    }
  }

  foreach($dataObject['updates'] as $update){
    if($update['resourceId'] == $resourceId){
      array_push($updates, $update);
    }
  }
}

?>
