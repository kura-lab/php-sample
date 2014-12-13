<?php

/**
 * RSA encrypt/decrypt
 *
 * @see http://php.net/manual/ja/function.openssl-private-encrypt.php
 *
 * $ openssl genrsa -out privatekey_rsa.pem 2048
 * $ openssl rsa -pubout -in privatekey_rsa.pem -out public_rsa.pem
 */

$privateKeyPath = './private_key_rsa.pem';
$publicKeyPath  = './public_key_rsa.pem';

$data = 'this is data';

echo "data : $data\n\n";

$privateKey = file_get_contents( $privateKeyPath );
if ( !$privateKey ) {
  echo "failed to open private key\n";
  exit;
}
$res = openssl_get_privatekey( $privateKey );

if ( !openssl_private_encrypt( $data, $encrypttext, $res ) ) {
  echo "encrypt error\n";
  exit;
}
echo "encrypttext: " . base64_encode( $encrypttext ) . "\n\n";

$publicKey = file_get_contents( $publicKeyPath );
if ( !$publicKey ) {
  echo "failed to open public key\n";
  exit;
}
$res = openssl_get_publickey( $publicKey );
if ( !$res ) {
  echo "";
  exit;
}

if ( !openssl_public_decrypt( $encrypttext, $decrypttext, $res ) ) {
  echo "decrypt error\n";
  exit;
}

echo "decrypttext: " . $decrypttext . "\n";
