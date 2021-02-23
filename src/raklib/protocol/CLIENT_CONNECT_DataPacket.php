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

namespace raklib\protocol;

use raklib\Binary;


class CLIENT_CONNECT_DataPacket extends Packet
{
    public static $ID = 0x09;

    public $clientID;
    public $sendPing;
    public $useSecurity = \false;

    public function encode()
    {
        parent::encode();
        $this->buffer .= Binary::writeLong($this->clientID);
        $this->buffer .= Binary::writeLong($this->sendPing);
        $this->buffer .= \chr($this->useSecurity ? 1 : 0);
    }

    public function decode()
    {
        parent::decode();
        $this->clientID = Binary::readLong($this->get(8));
        $this->sendPing = Binary::readLong($this->get(8));
        $this->useSecurity = \ord($this->get(1)) > 0;
    }
}
