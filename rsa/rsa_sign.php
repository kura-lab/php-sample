<?php

/**
 * Create RSA Signature and Verify it
 *
 * @see http://php.net/manual/ja/function.openssl-sign.php
 *
 * $ openssl genrsa -out privatekey_rsa.pem 2048
 * $ openssl rsa -pubout -in privatekey_rsa.pem -out public_rsa.pem
 */

// supported algorothms
//print_r(openssl_get_md_methods(true));

$data = "this is data";
$privateKeyId = openssl_pkey_get_private(file_get_contents('./private_key_rsa.pem'));
openssl_sign($data, $signature, $privateKeyId, 'RSA-SHA256');
openssl_free_key($privateKeyId);
echo "signature: \n" . base64_encode( $signature ) . "\n";

$publicKeyId = openssl_pkey_get_public(file_get_contents('./public_key_rsa.pem'));
$result = openssl_verify($data, $signature, $publicKeyId, 'RSA-SHA256');
openssl_free_key($publicKeyId);
if ($result == 1) {
  echo "result: valid\n";
} elseif ($result == 0) {
  echo "result: invalid\n";
} else {
  echo "result: error\n";
}
