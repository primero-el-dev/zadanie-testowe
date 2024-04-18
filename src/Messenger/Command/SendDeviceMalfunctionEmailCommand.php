<?php

namespace App\Messenger\Command;

use App\Messenger\Command\CommandInterface;

class SendDeviceMalfunctionEmailCommand implements CommandInterface
{
	public function __construct(
		public readonly array $deviceMalfunctionData
	) {}
}