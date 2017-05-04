<?php
namespace Flickr;
class People {
	public function __construct ($requestObject) {
		$this->Request = $requestObject;
	}

	public function getInfo ($userid) {
		return $this->Request->execute("flickr.people.getInfo", array(
			'user_id' => $userid
		), array(), 'GET');
	}

	public function url ($peopleObject, $size = 'large') {
		return 'http://farm'.$peopleObject->iconfarm.'.staticflickr.com/'.$peopleObject->iconserver.'/buddyicons/'.$peopleObject->nsid.($size == 'large' ? '_r' : '').'.jpg';
	}
}