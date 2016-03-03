<?php
	
	//autoloader
	require_once('vendor/autoload.php');

	//what we are using
	use Dao\Plug;

	//prepare your request
	$request = 'Something to send - maybe XML!';

	//instantiate a plug - creates a socket.
	$plug = new Plug();

	//connect the plug.
	$plug->connect('127.0.0.1', 5000);

	//switch it on and get the output.
	$output = $plug->on($request);

	//switch it off, we're done.
	$plug->off();