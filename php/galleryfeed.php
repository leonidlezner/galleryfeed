<?php

/**
 * Gallery feed info container
 */
class GalleryFeedInfoContainer
{
  function __construct()
  {
    $this->title = "";
    $this->author = "";
    $this->license = array('content' => '', 'href' => '');
  }

  function setTitle($newValue) {
    $this->title = $newValue;
  }

  function setAuthor($newValue) {
    $this->author = $newValue;
  }

  function setLicense($content, $href) {
    $this->license['content'] = $content;
    $this->license['href'] = $href;
  }

  function attachContainerInformation($parent) {
    # Gallery's title
    $parent->addChild('title', $this->title);

    # Gallery's author
    $parent->addChild('author', $this->author);

    # Gallery's license
    $license = $parent->addChild('license', $this->license['content']);
    $license->addAttribute('href', $this->license['href']);
  }
}


/**
 * Class for generating the gallery feed
 */
class GalleryFeed extends GalleryFeedInfoContainer {
  function __construct() {
    $this->gallery = new SimpleXMLElement('<gallery/>');
    $this->gallery->addAttribute('xsi:noNamespaceSchemaLocation',
                           'galleryfeed.xsd',
                           'http://www.w3.org/2001/XMLSchema-instance');



    $this->albums = array();
  }

  function newAlbum() {
    $album = new GalleryFeedAlbum();
    $this->albums[] = $album;
    return $album;
  }

  function asXML() {
    $this->attachContainerInformation($this->gallery);

    $albums = $this->gallery->addChild('albums');

    foreach ($this->albums as $album) {
      $album->attach($albums);
    }

    return $this->gallery->asXML();
  }
}

/**
 * Gallery feed album
 */
class GalleryFeedAlbum extends GalleryFeedInfoContainer {
  function __construct()
  {
    $this->images = array();
  }

  function attach($parent) {
    $album = $parent->addChild('album');

    $this->attachContainerInformation($album);
  }
}




?>
