<?php

return [
    'adminEmail' => 'admin@example.com',
    'baseUrl' => 'idFimo/',
    'img'=> 'idFimo/web/img/',
    'url_clientRegistration' => 'http://127.0.0.1:8080/c2id/clients',
    'url_token' => 'http://127.0.0.1:8080/c2id/token',
    'url_tokenRevocation' => 'http://127.0.0.1:8080/c2id/token/revoke',
    'url_authorizationSession' => 'http://127.0.0.1:8080/c2id/authz-sessions/rest/v3',
    "max_idle" => 10080,
    'scope' =>'openid email profile name fullname permission',
];
