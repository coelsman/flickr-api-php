<?php
function flickr_api_php_autoload ($class) {
	require_once str_replace('\\', '/', $class).'.php';
}

spl_autoload_register('flickr_api_php_autoload');