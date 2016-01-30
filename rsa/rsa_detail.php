<?php

/**
 * Desplay RSA Details
 *
 * @see http://php.net/manual/ja/function.openssl-pkey-get-details.php
 *
 * $ openssl genrsa -out privatekey_rsa.pem 2048
 * $ openssl rsa -pubout -in privatekey_rsa.pem -out public_rsa.pem
 */

// supported algorothms
//print_r(openssl_get_md_methods(true));

$publicKeyId = openssl_pkey_get_public(file_get_contents('./public_key_rsa.pem'));
$result = openssl_pkey_get_details($publicKeyId);

//var_dump($result);

var_dump(base64_encode($result['rsa']['n']));
var_dump(base64_encode($result['rsa']['e']));
