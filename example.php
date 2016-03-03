<?php
	
	require_once('vendor/autoload.php');

	use DannyAllen\Plug;


	$plug = new Plug();
	$plug->create($socket, $address, $service_port);
	$plug->connect($domain, $type, $protocol);
	$plug->on($request);
	$plug->off();