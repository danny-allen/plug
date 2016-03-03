<?php

namespace DannyAllen;

use Exception;

class Plug {

	private function socketConnect() {
		
		// echo "Attempting to connect to '$address' on port '$service_port'...";
		$result = @socket_connect($socket, $address, $service_port);
		if ($result === false) {
		     throw new Exception("socket_connect() failed.\nReason: ($result) " . socket_strerror(socket_last_error($socket)));
		}

	}


	private function socketCreate() {
		
		/* Create a TCP/IP socket. */
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

		if ($socket === false) {
		    throw new Exception("socket_create() failed: reason: " . socket_strerror(socket_last_error()));
		}
	}



}