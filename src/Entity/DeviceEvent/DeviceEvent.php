<?php

namespace App\Entity\DeviceEvent;

abstract class DeviceEvent
{
    private ?int $id = null;

    private ?int $deviceId = null;

    private ?int $eventDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeviceId(): ?int
    {
        return $this->deviceId;
    }

    public function setDeviceId(int $deviceId): static
    {
        $this->deviceId = $deviceId;

        return $this;
    }

    public function getEventDate(): ?int
    {
        return $this->eventDate;
    }

    public function setEventDate(int $eventDate): static
    {
        $this->eventDate = $eventDate;

        return $this;
    }
}
