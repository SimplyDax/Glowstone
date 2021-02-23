<?php

/*
 *
 *    ____ _                   _                   
 *  / ___| | _____      _____| |_ ___  _ __   ___ 
 * | |  _| |/ _ \ \ /\ / / __| __/ _ \| '_ \ / _ \
 * | |_| | | (_) \ V  V /\__ \ || (_) | | | |  __/
 *  \____|_|\___/ \_/\_/ |___/\__\___/|_| |_|\___|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author Glowstone (Lemdy)
 * @link vk.com/weany
 *
 */

namespace raklib\server;

class UDPServerSocket{
	/** @var \Logger */
	protected $logger;
	protected $socket;

	public function __construct(\ThreadedLogger $logger, $port = 19132, $interface = "0.0.0.0"){
		$this->socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
		//socket_set_option($this->socket, SOL_SOCKET, SO_BROADCAST, 1); //Allow sending broadcast messages
		if(@socket_bind($this->socket, $interface, $port) === true){
			socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 0);
			$this->setSendBuffer(1024 * 1024 * 8)->setRecvBuffer(1024 * 1024 * 8);
		}else{
			$logger->critical("Сервер уже запущен на порту: " . $interface . ":" . $port . "!", true, true, 0);
			$logger->critical("Запуск сервера не удался!", true, true, 0);
			exit(1);
		}
		socket_set_nonblock($this->socket);
	}

	public function getSocket(){
		return $this->socket;
	}

	public function close(){
		socket_close($this->socket);
	}

	/**
	 * @param string &$buffer
	 * @param string &$source
	 * @param int    &$port
	 *
	 * @return int
	 */
	public function readPacket(&$buffer, &$source, &$port){
		return socket_recvfrom($this->socket, $buffer, 65535, 0, $source, $port);
	}

	/**
	 * @param string $buffer
	 * @param string $dest
	 * @param int    $port
	 *
	 * @return int
	 */
	public function writePacket($buffer, $dest, $port){
		return socket_sendto($this->socket, $buffer, strlen($buffer), 0, $dest, $port);
	}

	/**
	 * @param int $size
	 *
	 * @return $this
	 */
	public function setSendBuffer($size){
		@socket_set_option($this->socket, SOL_SOCKET, SO_SNDBUF, $size);

		return $this;
	}

	/**
	 * @param int $size
	 *
	 * @return $this
	 */
	public function setRecvBuffer($size){
		@socket_set_option($this->socket, SOL_SOCKET, SO_RCVBUF, $size);

		return $this;
	}

}

?>