RSA Sample
==========

# Make RSA private/public key

```
$ openssl genrsa -out private_key_rsa.pem 2048
$ openssl rsa -in private_key_rsa.pem -pubout -out public_key_rsa.pem
```

* Create key with AES

```
$ openssl genrsa -out private_key_rsa.pem -aes256 2048
$ openssl rsa -in private_key_rsa.pem -pubout -out public_key_rsa.pem
```
