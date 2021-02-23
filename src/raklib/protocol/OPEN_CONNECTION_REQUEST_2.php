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
use raklib\RakLib;


class OPEN_CONNECTION_REQUEST_2 extends Packet
{
    public static $ID = 0x07;

    public $clientID;
    public $serverAddress;
    public $serverPort;
    public $mtuSize;

    public function encode()
    {
        parent::encode();
        $this->buffer .= RakLib::MAGIC;
        $this->putAddress($this->serverAddress, $this->serverPort, 4);
        $this->buffer .= \pack("n", $this->mtuSize);
        $this->buffer .= Binary::writeLong($this->clientID);
    }

    public function decode()
    {
        parent::decode();
        $this->offset += 16; //Magic
        $this->getAddress($this->serverAddress, $this->serverPort);
        $this->mtuSize = \unpack("n", $this->get(2))[1];
        $this->clientID = Binary::readLong($this->get(8));
    }
}
