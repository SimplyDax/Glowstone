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

namespace pocketmine\event\entity;

use pocketmine\entity\Creeper;
use pocketmine\event\Cancellable;
use pocketmine\entity\Lightning;

class CreeperPowerEvent extends EntityEvent implements Cancellable{
	public static $handlerList = null;

	const CAUSE_SET_ON = 0;
	const CAUSE_SET_OFF = 1;
	const CAUSE_LIGHTNING = 2;

	/** @var  Lightning */
	private $lightning;

	private $cause;

	public function __construct(Creeper $creeper, Lightning $lightning = null, int $cause = self::CAUSE_LIGHTNING){
		$this->entity = $creeper;
		$this->lightning = $lightning;
		$this->cause = $cause;
	}

	public function getLightning(){
		return $this->lightning;
	}

	public function getCause(){
		return $this->cause;
	}
}
