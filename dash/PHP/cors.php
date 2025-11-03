<?php
/**
 * This file sets the CORS headers for the application.
 * It ensures proper cross-origin resource sharing configuration.
 *
 * @category Configuration
 * @package  DoctorWhoFansBE
 * @author   Your Name <your.email@example.com>
 * @license  MIT License
 * @link     https://example.com
 * @version  PHP 8.0
 */
    header(
        'Access-Control-Allow-Origin: *'
    );
    header(
        'Access-Control-Allow-Methods: GET, POST, OPTIONS'
    );
    header(
        'Access-Control-Max-Age: 1000'
    );
    header(
        "Access-Control-Allow-Credentials: true"
    );
    header(
        'Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With'
    );
    header(
        'Strict-Transport-Security: max-age=63072000; includeSubDomains; preload'
    );
    ?>