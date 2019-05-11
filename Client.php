<?php

use GuzzleHttp\Client;
use Service\ConfigProvider;

include (__DIR__ . '/vendor/autoload.php');



$client = new Client();

$request = $client->createRequest('GET', 'https://opentdb.com/api.php?difficulty=easy&amount=1');

$response = $client->send($request);
echo $response->getBody();


$json = '{"response_code":0,"results":[{"category":"Entertainment: Video Games","type":"multiple","difficulty":"easy","question":"If a &quot;360 no-scope&quot; is one full rotation before shooting, how many rotations would a &quot;1080 no-scope&quot; be?","correct_answer":"3","incorrect_answers":["4","2","5"]}]}';

//var_dump(json_decode($json));

$arr = jsone_decode($json, true);
echo $arr["0"];



