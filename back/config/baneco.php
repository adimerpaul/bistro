<?php

return [
    'base_url' => env('BANECO_BASE_URL', 'https://apimktdesa.baneco.com.bo/ApiGateway'),
    'aes_key' => env('BANECO_AES_KEY', '40A318B299F245C2B697176723088629'),
    'username' => env('BANECO_USERNAME', '26551010'),
    'password' => env('BANECO_PASSWORD', '1234'),
    'account_credit' => env('BANECO_ACCOUNT_CREDIT', '1061602532'),
    'branch_code' => env('BANECO_BRANCH_CODE', 'E0001'),
    // Bundle de CA para evitar "SSL certificate problem" en entornos (ej. Windows)
    // sin CA bundle configurado en php.ini. Se ignora si el archivo no existe.
    'ca_cert' => env('BANECO_CA_CERT', storage_path('certs/baneco_cacert.pem')),
];
