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

namespace pocketmine;

use pocketmine\event\TranslationContainer;
use pocketmine\utils\TextFormat;

/**
 * Handles the achievement list and a bit more
 */

abstract class Achievement{
	/**
	 * @var array[]
	 */
	public static $list = [
		/*"openInventory" => array(
			"name" => "Проверить карманы",
			"requires" => [],
		),*/
		"mineWood" => [
			"name" => "Нарубить дров",
			"requires" => [ //"openInventory",
			],
		],
		"buildWorkBench" => [
			"name" => "Рабочий стол",
			"requires" => [
				"mineWood",
			],
		],
		"buildPickaxe" => [
			"name" => "Пора в шахту",
			"requires" => [
				"buildWorkBench",
			],
		],
		"buildFurnace" => [
			"name" => "Горячая штучка",
			"requires" => [
				"buildPickaxe",
			],
		],
		"acquireIron" => [
			"name" => "Куй железо",
			"requires" => [
				"buildFurnace",
			],
		],
		"buildHoe" => [
			"name" => "Время для фермы",
			"requires" => [
				"buildWorkBench",
			],
		],
		"makeBread" => [
			"name" => "Хлеб насущный",
			"requires" => [
				"buildHoe",
			],
		],
		"bakeCake" => [
			"name" => "Это ложь",
			"requires" => [
				"buildHoe",
			],
		],
		"buildBetterPickaxe" => [
			"name" => "Обновка",
			"requires" => [
				"buildPickaxe",
			],
		],
		"buildSword" => [
			"name" => "К бою готов",
			"requires" => [
				"buildWorkBench",
			],
		],
		"diamonds" => [
			"name" => "Алмазы",
			"requires" => [
				"acquireIron",
			],
		],

	];


	public static function broadcast(Player $player, $achievementId){
		if(isset(Achievement::$list[$achievementId])){
			$translation = new TranslationContainer("chat.type.achievement", [$player->getName(), TextFormat::GREEN . Achievement::$list[$achievementId]["name"]]);
			if(Server::getInstance()->getConfigString("announce-player-achievements", true) === true){
				Server::getInstance()->broadcastMessage($translation);
			}else{
				$player->sendMessage($translation);
			}

			return true;
		}

		return false;
	}

	public static function add($achievementId, $achievementName, array $requires = []){
		if(!isset(Achievement::$list[$achievementId])){
			Achievement::$list[$achievementId] = [
				"name" => $achievementName,
				"requires" => $requires,
			];

			return true;
		}

		return false;
	}


}
