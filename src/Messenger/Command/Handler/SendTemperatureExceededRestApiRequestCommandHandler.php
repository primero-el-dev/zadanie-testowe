<?php

namespace App\Messenger\Command\Handler;

use App\Messenger\Command\Handler\CommandHandlerInterface;
use App\Messenger\Command\SendTemperatureExceededRestApiRequestCommand;

class SendTemperatureExceededRestApiRequestCommandHandler implements CommandHandlerInterface
{
	public function __invoke(SendTemperatureExceededRestApiRequestCommand $command): void
	{
		echo 'SENDING REST API REQUEST' . PHP_EOL;
	}
}