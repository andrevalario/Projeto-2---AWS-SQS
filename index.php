<?php

require_once "vendor/autoload.php";

$queueUrl = "https://sqs.us-east-1.amazonaws.com/220813681810/teste1";

$client = new \Aws\Sqs\SqsClient([
    'profile' => 'default',
    'region' => 'us-east-1',
    'version' => 'latest',
    'scheme' =>'http',
    'ssl.certificate_authority' => 'cacert-2021-01-19.pem'

]);



try{

    $result = $client->receiveMessage([
        'QueueUrl' => $queueUrl
    ]);

    if(!empty($result->get("Messages"))){

        echo $result->get("Messages")[0]['Body'] . PHP_EOL;

        $client -> deleteMessage([
            'QueueUrl'=>$queueUrl,
            'ReceiptHandle'=>$result->get("Messages")[0]["ReceiptHandle"]

        ]);

    } else {
        echo "Sem mensagens na fila!\n";
    }

} catch (\Aws\Exception\AwsExpection $e) {

}