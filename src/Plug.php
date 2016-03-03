<?php

//where we are
namespace DannyAllen;

//what we're using
use Exception;



/**
 * Plug
 *
 * A simple object orientated way of dealing with sockets.
 */
class Plug {

	/**
	 * $_socket
	 *
	 * This will hold the socket connection.
	 */
	private $_socket = false;


	/**
	 * $_response
	 *
	 * This will hold the response to the socket connection.
	 */
	private $_response = null;



	/**
	 * __construct
	 *
	 * On instantiation, the socket is created.
	 * 
	 * @param const 	$domain    	Protocol family to be used by the socket.
	 * @param const 	$type     	The type of communication used by the socket.
	 * @param const 	$protocol 	Protocol within the domain, to be used when communicating on the returned socket.
	 */
	public function __construct($domain = AF_INET, $type = SOCK_STREAM, $protocol = SOL_TCP) {
		
		/* Create a TCP/IP socket. */
		$this->_socket = socket_create($domain, $type, $protocol);

		//if no socket, throw exception
		if ($this->_socket === false) {
		    throw new Exception("Could not create the socket. Reason: " . socket_strerror(socket_last_error()));
		}
	}


	/**
	 * connect
	 *
	 * connect to the socket using the address and port number.
	 * 
	 * @param string 			$domain    	The address to connect to.
	 * @param service_port  	$type     	The port to connect with.
	 */
	public function connect($address = '127.0.0.1', $service_port = 0) {
		
		//connect to the socket and store the response.
		$connection = @socket_connect($this->_socket, $address, $service_port);

		//if no result, throw exception.
		if ($connection === false) {
		     throw new Exception("Couldn't connect to the socket. Reason: ($connection) " . socket_strerror(socket_last_error($this->_socket)));
		}
	}


	/**
	 * on
	 *
	 * Writes the request to the socket and reads back the response.
	 * 
	 * @param  string 	$request 	The data to write to the socket.
	 * 
	 * @return string 	$response 	The response returned from the socket.
	 */
	public function on($request) {

		//write to the socket.
		socket_write($this->_socket, $request, strlen($request));
		
		//loop through each line and store as the response.
		while ($out = socket_read($this->_socket, 2048)) {
		    $this->_response .= $out;
		}

		//return the response.
		return $this->_response;
	}


	/**
	 * off
	 *
	 * Close the connection for the socket.
	 */
	public function off() {
		socket_close($this->_socket);
	}
}