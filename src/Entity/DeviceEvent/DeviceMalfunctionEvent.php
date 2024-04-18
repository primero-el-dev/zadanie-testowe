<?php

namespace App\Entity\DeviceEvent;

use App\Entity\DeviceEvent\DeviceEvent;
use Symfony\Component\Serializer\Annotation\SerializedName;

class DeviceMalfunctionEvent extends DeviceEvent
{
    private ?int $reasonCode = null;

    private ?string $reasonText = null;

    public function getReasonCode(): ?int
    {
        return $this->reasonCode;
    }

    public function setReasonCode(int $reasonCode): static
    {
        $this->reasonCode = $reasonCode;

        return $this;
    }

    public function getReasonText(): ?string
    {
        return $this->reasonText;
    }

    public function setReasonText(string $reasonText): static
    {
        $this->reasonText = $reasonText;

        return $this;
    }
}
