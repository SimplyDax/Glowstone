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


class CLIENT_HANDSHAKE_DataPacket extends Packet
{
    public static $ID = 0x13;

    public $address;
    public $port;

    public $systemAddresses = [];

    public $sendPing;
    public $sendPong;

    public function encode()
    {

    }

    public function decode()
    {
        parent::decode();
        $this->getAddress($this->address, $this->port);
        for ($i = 0; $i < 10; ++$i) {
            $this->getAddress($addr, $port, $version);
            $this->systemAddresses[$i] = [$addr, $port, $version];
        }

        $this->sendPing = Binary::readLong($this->get(8));
        $this->sendPong = Binary::readLong($this->get(8));
    }
}
