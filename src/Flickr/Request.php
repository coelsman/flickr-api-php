<?php
namespace Flickr;
class Request {
	protected $apikey;
	protected $_curlHeader = array();

	public $domain = 'https://api.flickr.com/services/rest';

	public function __construct ($apikey) {
		$this->response = new Response();

		$this->apikey = $apikey;
	}

	public function execute ($endpoint, $params = array(), $headers = array(), $method = 'POST') {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 300);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$params['method']         = $endpoint;
		$params['format']         = 'json';
		$params['nojsoncallback'] = 1;

		if (!isset($params['api_key'])) {
			$params['api_key'] = $this->apikey;
		}

		if ($method == 'POST') {
			curl_setopt($ch, CURLOPT_URL, $this->domain . $endpoint);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
		} else {
			curl_setopt($ch, CURLOPT_URL, $this->domain . '?' . http_build_query($params));
		}

		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->_buildHeaders(array_merge($this->_curlHeader, $headers)));

		$output = curl_exec($ch);
		$httpResponse = curl_getinfo($ch);
		curl_close($ch);

		if ($httpResponse['http_code'] == 200) {
			return $this->response->response(true, $httpResponse['http_code'], json_decode($output));
		} else {
			return $this->response->response(false, $httpResponse['http_code'], json_decode($output));
		}
	}

	protected function _buildHeaders ($headers = array()) {
		$properties = array();

		foreach ($headers as $k => $header) {
			$properties[] = $k . ': '.$header;
		}

		return $properties;
	}
}