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


abstract class DataPacket extends Packet
{

    /** @var EncapsulatedPacket[] */
    public $packets = [];

    public $seqNumber;

    public function encode()
    {
        parent::encode();
        $this->buffer .= \substr(\pack("V", $this->seqNumber), 0, -1);
        foreach ($this->packets as $packet) {
            $this->buffer .= $packet instanceof EncapsulatedPacket ? $packet->toBinary() : (string)$packet;
        }
    }

    public function length()
    {
        $length = 4;
        foreach ($this->packets as $packet) {
            $length += $packet instanceof EncapsulatedPacket ? $packet->getTotalLength() : \strlen($packet);
        }

        return $length;
    }

    public function decode()
    {
        parent::decode();
        $this->seqNumber = \unpack("V", $this->get(3) . "\x00")[1];

        while (!$this->feof()) {
            $offset = 0;
            $data = \substr($this->buffer, $this->offset);
            $packet = EncapsulatedPacket::fromBinary($data, \false, $offset);
            $this->offset += $offset;
            if (\strlen($packet->buffer) === 0) {
                break;
            }
            $this->packets[] = $packet;
        }
    }

    public function clean()
    {
        $this->packets = [];
        $this->seqNumber = \null;
        return parent::clean();
    }
}
