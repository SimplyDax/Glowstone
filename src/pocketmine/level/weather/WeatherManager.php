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

namespace pocketmine\level\weather;

use pocketmine\level\Level;

/**
 * @deprecated
 */
class WeatherManager{
	/** @var Level[] */
	public static $registeredLevel = [];
	
	public static function registerLevel(Level $level){
		self::$registeredLevel[$level->getName()] = $level;
		return true;
	}
	
	public static function unregisterLevel(Level $level){
		if(isset(self::$registeredLevel[$level->getName()])) {
			unset(self::$registeredLevel[$level->getName()]);
			return true;
		}
		return false;
	}
	
	public static function updateWeather(){
		foreach(self::$registeredLevel as $level) {
			$level->getWeather()->calcWeather($level->getServer()->getTick());
		}
	}
	
	public static function isRegistered(Level $level){
		if(isset(self::$registeredLevel[$level->getName()])) return true;
		return false;
	}

}