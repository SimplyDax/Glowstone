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

use pocketmine\block\Block;
use pocketmine\event\Cancellable;
use pocketmine\item\Item;
use pocketmine\Player;

class PlayerGlassBottleEvent extends PlayerEvent implements Cancellable{
    public static $handlerList = null;

    /** @var Block */
    private $target;
    /** @var Item */
    private $item;

    /**
     * @param Player $Player
     * @param Block  $target
     * @param Item   $itemInHand
     */
    public function __construct(Player $Player, Block $target, Item $itemInHand){
        $this->player = $Player;
        $this->target = $target;
        $this->item = $itemInHand;
    }
    
    /**
     * @return Item
     */
    public function getItem(){
        return $this->item;
    }

    /**
     * @param Item $item
     */
    public function setItem(Item $item){
        $this->item = $item;
    }

    /**
     * @return Block
     */
    public function getBlock(){
        return $this->target;
    }
}