<?php

namespace App\Messenger\Command;

use App\Messenger\Command\CommandInterface;

class SendTemperatureExceededRestApiRequestCommand implements CommandInterface
{
	public function __construct(
		public readonly array $temperatureExceededData
	) {}
}