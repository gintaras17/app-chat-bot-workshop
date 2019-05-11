<?php

use Facebook\Facebook;
use Service\ConfigProvider;
use GuzzleHttp\Client;

include (__DIR__ . '/vendor/autoload.php');

$configProvider = new ConfigProvider(__DIR__ . '/config.json');
//$questionProvider = new QuestionProvider;


$access_token = 'EAAGQtIYzFWwBABqZA7hNuHc6giUkTcUJkbZARKPXrKRufUUloESDL9vDAmisJKTb84UVVedX3tciS0qMyTgP1nm6OBe1gAjqlAybZBLUjWaUWs3ZBoUscquBIPZBfGZA7t8q2iupRB2LDDPafrTIK4KPM1m5tiLLvIqsxYCLzhRZBT0mTfuiKVan75unXn380sZD';
$verify_token = 'TOKEN';
$appId = '440579996718444';
$appSecret = '0a616694da09d940a6a3d0933b9c9c93';

if(isset($_REQUEST['hub_challenge'])) {
    $challenge = $_REQUEST['hub_challenge'];
    if ($_REQUEST['hub_verify_token'] === $configProvider->getParameter('verify_token')) {
        echo $challenge; die();
    }
}

$input = json_decode(file_get_contents('php://input'), true);

if ($input === null) {
    exit;
}

$message = $input['entry'][0]['messaging'][0]['message']['text'];
$sender = $input['entry'][0]['messaging'][0]['sender']['id'];

$fb = new Facebook([
    'app_id' => $appId,
    'app_secret' => $appSecret,
]);

$data = [
    'messaging_type' => 'RESPONSE',
    'recipient' => [
        'id' => $sender,
    ],
    'message' => [
        'text' => 'You wrote: ' . $message,
    ]
];

$response = $fb->post('/me/messages', $data, $configProvider->getParameter('access_token'));

