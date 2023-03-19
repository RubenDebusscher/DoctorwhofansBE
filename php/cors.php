<?php
    //header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

    header("Content-Security-Policy:default-src 'self' https://www.facebook.com 'strict-dynamic' 'nonce-Rand0m0123' 'unsafe-inline' sharethis.com 'strict-dynamic' 'nonce-Rand0m0123' 'unsafe-inline' googletagmanager.com 'strict-dynamic' 'nonce-Rand0m0123' 'unsafe-inline' ; img-src *; media-src 'self'; object-src 'none';require-trusted-types-for 'script';base-uri 'self'");
    
?>
