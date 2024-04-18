<?php

namespace App\Messenger\Command;

use App\Messenger\Command\CommandInterface;

class SendDoorUnlockedSmsCommand implements CommandInterface
{
	public function __construct(
		public readonly array $doorUnlockedData
	) {}
}