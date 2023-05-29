<?php 
/*Piergaetano Di Vita O46001380*/


/*Qui implemento lato server quell'api che richiede l'utilizzo di credenziali segrete*/
require_once 'auth.php';
if (!checkAuth()) exit;

$token;
$email = 'piergaetano97.97@gmail.com';
$password = '123ciao45'; 

$header = array("Content-Type" => "application/x-www-form-urlencoded");
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL,'https://kitsu.io/api/oauth/token');
curl_setopt($curl, CURLOPT_POST,1);
curl_setopt($curl, CURLOPT_POSTFIELDS,"grant_type=password&username=$email&password=$password");
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
$token=json_decode(curl_exec($curl), true);
curl_close($curl);

$header2= array(
    'Accept' => 'application/vnd.api+json',
    'Authorization:' => $token['token_type'].''.$token['access_token'],
    'Content-Type' => 'application/x-wwwform-urlencoded'
);

$curl2 = curl_init();
curl_setopt($curl2, CURLOPT_URL,'https://kitsu.io/api/edge/anime?filter[text]'.$_GET['q']);
curl_setopt($curl2, CURLOPT_HTTPHEADER, $header2);
curl_setopt($curl2, CURLOPT_RETURNTRANSFER,1);
$json=curl_exec($curl2);
curl_close($curl2);
echo $json;

