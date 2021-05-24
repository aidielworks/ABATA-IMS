<?php
$curl = curl_init();

curl_setopt($curl, CURLOPT_POST, 0);
curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/getBank');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);
$info = curl_getinfo($curl);
curl_close($curl);

$myArray = json_decode($result);

var_dump($myArray);
