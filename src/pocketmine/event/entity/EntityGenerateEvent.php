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

use pocketmine\entity\Entity;
use pocketmine\event\Cancellable;
use pocketmine\level\Position;

class EntityGenerateEvent extends EntityEvent implements Cancellable{
	public static $handlerList = null;

	const CAUSE_AI_HOLDER = 0;
	const CAUSE_MOB_SPAWNER = 1;

	/** @var Position  */
	private $position;
	private $cause;
	private $entityType;

	public function __construct(Position $pos, int $entityType, int $cause = self::CAUSE_MOB_SPAWNER){
		$this->position = $pos;
		$this->entityType = $entityType;
		$this->cause = $cause;
	}

	/**
	 * @return Position
	 */
	public function getPosition(){
		return $this->position;
	}

	public function setPosition(Position $pos){
		$this->position = $pos;
	}

	/**
	 * @return int
	 */
	public function getType() : int{
		return $this->entityType;
	}

	/**
	 * @return int
	 */
	public function getCause() : int{
		return $this->cause;
	}
}