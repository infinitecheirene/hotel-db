<?php

return [
'paths' => ['api/*'],
'allowed_methods' => ['*'],
'allowed_origins' => ['http://localhost:3000'], // Your Next.js URL
'allowed_headers' => ['*'],
'supports_credentials' => true,
];