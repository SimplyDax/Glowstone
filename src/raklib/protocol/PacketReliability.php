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

class PacketReliability {
	
	//pure UDP, but will discard duplicate packets
	const UNRELIABLE = 0;

	//same as unreliable, but will discard messages
	//that arrive out of order
	const UNRELIABLE_SEQUENCED = 1;

	//ensures that the packet reaches the destination
	//but can arrive in any order
	const RELIABLE = 2;

	//same as reliable, but ensures the packets arrive
	//in the correct order.
	const RELIABLE_ORDERED = 3;

	//same as reliable, but out of order messages will be dropped
	const RELIABLE_SEQUENCED = 4;

	const UNRELIABLE_WITH_ACK_RECEIPT = 5;
	const RELIABLE_WITH_ACK_RECEIPT = 6;

	//basically the same as TCP
	const RELIABLE_ORDERED_WITH_ACK_RECEIPT = 7;
}
