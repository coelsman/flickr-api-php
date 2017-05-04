<?php
require_once 'src/autoload.php';
$apikey = '8677f2785b83246fdc92d732ecee75dc';

$flickr = new Flickr($apikey);
$data = $flickr->Photo->search('funny');
echo json_encode($data);