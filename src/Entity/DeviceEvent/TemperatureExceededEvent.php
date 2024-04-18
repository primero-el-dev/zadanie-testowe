<?php

namespace App\Entity\DeviceEvent;

use App\Entity\DeviceEvent\DeviceEvent;

class TemperatureExceededEvent extends DeviceEvent
{
    private ?float $temp = null;

    private ?float $treshold = null;

    public function getTemp(): ?float
    {
        return $this->temp;
    }

    public function setTemp(float $temp): static
    {
        $this->temp = $temp;

        return $this;
    }

    public function getTreshold(): ?float
    {
        return $this->treshold;
    }

    public function setTreshold(float $treshold): static
    {
        $this->treshold = $treshold;

        return $this;
    }
}
