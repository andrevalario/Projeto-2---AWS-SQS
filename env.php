<?php

require 'vendor/autoload.php';

use Aws\Sqs\SqsClient; 
use Aws\Exception\AwsException;

$queueUrl = "https://sqs.us-east-1.amazonaws.com/220813681810/teste1";

$client = new SqsClient([
    'profile' => 'default',
    'region' => 'us-east-1',
    'version' => 'latest'
]);

$params = [
    'DelaySeconds' => 10,
    'MessageAttributes' => [
        "Title" => [
            'DataType' => "String",
            'StringValue' => "Testes"
        ],
        "Author" => [
            'DataType' => "String",
            'StringValue' => "Andre Valario"
        ],
        "WeeksOn" => [
            'DataType' => "Number",
            'StringValue' => "6"
        ]
    ],
    'MessageBody' => "Teste Topicos de Software - TESTE",
    'QueueUrl' => 'https://sqs.us-east-1.amazonaws.com/220813681810/teste1'
];

try {
    $result = $client->sendMessage($params);
    var_dump($result);
} catch (AwsException $e) {
    error_log($e->getMessage());
}