<?php

/**
 * RSA encrypt/decrypt with openssl_seal
 *
 * @see http://php.net/manual/ja/function.openssl-seal.php
 *
 * $ openssl genrsa -out privatekey_rsa.pem 2048
 * $ openssl rsa -pubout -in privatekey_rsa.pem -out public_rsa.pem
 */

$privateKeyPath = './private_key_rsa.pem';
$publicKeyPath  = './public_key_rsa.pem';

$data = 'this is data';

echo "data : $data\n";

$publicKey = openssl_pkey_get_public( file_get_contents( $publicKeyPath ) );

openssl_seal( $data, $sealedData, $envKeys, array( $publicKey ) );

echo "sealed data: " . base64_encode( $sealedData ) . "\n";
echo "envKeys : " . base64_encode( $envKeys[0] ) . "\n";

openssl_free_key( $publicKey );

$privateKey = openssl_pkey_get_private( file_get_contents( $privateKeyPath ) );

if ( !openssl_open( $sealedData, $openData, $envKeys[0], $privateKey ) ) {
  // error
}

openssl_free_key( $privateKey );

echo "open data: " . $openData . "\n";

