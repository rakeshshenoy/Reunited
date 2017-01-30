<?php
define( 'API_BASE_URL',     'https://westus.api.cognitive.microsoft.com/face/v1.0/verify?' );
define( 'API_PRIMARY_KEY',      'dd51642516ac431a9c593b4c78b8a806' );
//$img = 'http://media.gq.com/photos/5711559a3c2c86f474dc6d5a/master/pass/chris-paul-3.jpg';
$faceId1 = 'fb7fa7f9-7a7b-484c-b7db-0593b3747cfb';
$faceId2 = '706a8182-18c0-4575-93ca-76b2adabe35f';

//$post_string = '{"url":"' . $img . '"}';
$post_string = '{"faceId1":"' . $faceId1 . '", "faceId2":"' . $faceId2 . '"}';

$query_params = array(
);

$params = '';
/*foreach( $query_params as $key => $value ) {
    $params .= $key . '=' . $value . '&';
}*/
$params .= 'subscription-key=' . API_PRIMARY_KEY;

$post_url = API_BASE_URL . $params;

$ch = curl_init();
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array(                                                                          
        'Content-Type: application/json',                                                                                
        'Content-Length: ' . strlen($post_string))
    );    

    curl_setopt( $ch, CURLOPT_URL, $post_url );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $post_string );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $response = curl_exec( $ch );
curl_close( $ch );

//print_r( '<pre>' );
var_dump( $response );
?>