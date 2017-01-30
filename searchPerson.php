<?php
require_once 'HTTP/Request2.php';

echo "Hello!";
$request = new Http_Request2('https://westus.api.cognitive.microsoft.com/face/v1.0/verify');
$url = $request->getUrl();
?>