<?php
namespace Flickr;
class Photo {
	public function __construct ($requestObject) {
		$this->Request = $requestObject;
	}

	public function search ($keyword, $page = 1) {
		return $this->Request->execute("flickr.photos.search", array(
			'tags' => $keyword,
			'page' => intval($page)
		), array(), 'GET');
	}

	public function url ($photoObject, $size = 'z') {
		return 'https://farm'.$photoObject->farm.'.staticflickr.com/'.$photoObject->server.'/'.$photoObject->id.'_'.$photoObject->secret.'_'.$size.'.jpg';
	}

	public function urlPost ($photoObject) {
		return 'https://www.flickr.com/photos/'.$photoObject->owner.'/'.$photoObject->id;
	}
}