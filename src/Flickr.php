<?php
class Flickr {
	public $Request;
	public $Photo;
	public $People;

	public function __construct ($apikey) {
		$this->Request = new Flickr\Request($apikey);
		$this->Photo = new Flickr\Photo($this->Request);
		$this->People = new Flickr\People($this->Request);
	}
}