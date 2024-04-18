<?php

namespace App\Messenger\Command\Handler;

use App\Messenger\Command\Handler\CommandHandlerInterface;
use App\Messenger\Command\SendDeviceMalfunctionEmailCommand;

class SendDeviceMalfunctionEmailCommandHandler implements CommandHandlerInterface
{
	public function __invoke(SendDeviceMalfunctionEmailCommand $command): void
	{
		echo 'SENDING EMAIL' . PHP_EOL;
	}
}