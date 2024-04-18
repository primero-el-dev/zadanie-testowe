<?php

namespace App\Messenger\Command\Handler;

use App\Messenger\Command\Handler\CommandHandlerInterface;
use App\Messenger\Command\SendDoorUnlockedSmsCommand;

class SendDoorUnlockedSmsCommandHandler implements CommandHandlerInterface
{
	public function __invoke(SendDoorUnlockedSmsCommand $command): void
	{
		echo 'SENDING SMS' . PHP_EOL;
	}
}