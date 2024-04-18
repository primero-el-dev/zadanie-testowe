<?php

namespace App\Entity\DeviceEvent;

use App\Entity\DeviceEvent\DeviceEvent;

class DoorUnlockedEvent extends DeviceEvent
{
    private ?int $unlockDate = null;

    public function getUnlockDate(): ?int
    {
        return $this->unlockDate;
    }

    public function setUnlockDate(int $unlockDate): static
    {
        $this->unlockDate = $unlockDate;

        return $this;
    }
}
