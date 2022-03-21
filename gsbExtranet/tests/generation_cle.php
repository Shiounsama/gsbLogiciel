<?php


$file = '../css/Charlote_aux_fraise_nonce.txt';
$nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
file_put_contents($file, $nonce, FILE_APPEND | LOCK_EX);
echo $nonce;