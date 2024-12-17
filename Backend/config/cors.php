<?php

return [
    'paths' => ['api/*', 'user-login', 'sanctum/csrf-cookie'], // Add all paths requiring CORS
    'allowed_methods' => ['*'], // Allow all HTTP methods
    'allowed_origins' => ['http://localhost:5173'], // Add your React app's URL
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Allow all headers
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // Enable for cookies or authorization headers
];
