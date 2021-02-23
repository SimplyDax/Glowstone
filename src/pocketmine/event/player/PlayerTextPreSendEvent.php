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

namespace pocketmine\event\player;

use pocketmine\event\Cancellable;
use pocketmine\Player;

/**
 * Called when a player is sent to some messages by using sendMessage, sendPopup and sendTip
 */
class PlayerTextPreSendEvent extends PlayerEvent implements Cancellable{
	const MESSAGE = 0;
	const POPUP = 1;
	const TIP = 2;
	const TRANSLATED_MESSAGE = 3;

	public static $handlerList = null;

	protected $message;
	protected $type = self::MESSAGE;

	public function __construct(Player $player, $message, $type = self::MESSAGE){
		$this->player = $player;
		$this->message = $message;
		$this->type = $type;
	}

	public function getMessage(){
		return $this->message;
	}

	public function setMessage($message){
		$this->message = $message;
	}

	public function getType(){
		return $this->type;
	}

}