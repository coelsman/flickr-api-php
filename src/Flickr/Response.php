<?php
namespace Flickr;
class Response {
	public function response ($status, $httpCode, $body) {
		$response           = new \stdClass();
		$response->success  = $status;
		$response->httpCode = $httpCode;
		$response->body     = $body;

		return $response;
	}
}