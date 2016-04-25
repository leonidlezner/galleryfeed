<?php
include('galleryfeed.php');

$feed = new GalleryFeed();

$feed->setAuthor('Leonid Lezner');
$feed->setTitle('My Gallery');
$feed->setLicense('Public Domain Dedication', 'https://creativecommons.org/publicdomain/zero/1.0/');

$album = $feed->newAlbum();



/*
$gallery = new SimpleXMLElement('<gallery/>');




$album = $gallery->addChild('album');

$image = $album->addChild('image');
*/




echo $feed->asXML();


?>
