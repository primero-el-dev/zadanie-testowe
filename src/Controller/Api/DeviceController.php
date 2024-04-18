<?php

namespace App\Controller\Api;

use App\Entity\DeviceEvent\DeviceEvent;
use App\Entity\DeviceEvent\DeviceMalfunctionEvent;
use App\Entity\DeviceEvent\DoorUnlockedEvent;
use App\Entity\DeviceEvent\TemperatureExceededEvent;
use App\Form\DeviceEvent\DeviceMalfunctionEventType;
use App\Form\DeviceEvent\DoorUnlockedEventType;
use App\Form\DeviceEvent\TemperatureExceededEventType;
use App\Messenger\Command\SendDeviceMalfunctionEmailCommand;
use App\Messenger\Command\SendDoorUnlockedSmsCommand;
use App\Messenger\Command\SendTemperatureExceededRestApiRequestCommand;
use Symfony\Component\Form\FormInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

#[Route('/api/devices')]
class DeviceController extends AbstractController
{
    public function __construct(private MessageBusInterface $commandBus) {}

    #[Route('/events/', name: 'api_devices_events_index', methods: 'GET')]
    public function eventsIndex(): JsonResponse
    {
        return $this->json([
            'events' => [
                [
                    'deviceId' => 'A23',
                    'eventDate' => 1710355477,
                    'type' => 'deviceMulfunction',
                    'evtData' => [
                        'reasonCode' => 12,
                        'reasonText' => 'temp sensor not responding'
                    ]
                ],
                [
                    'deviceId' => 'A23',
                    'eventDate' => 1710354477,
                    'type' => 'deviceMulfunction',
                    'evtData' => [
                        'reasonCode' => 11,
                        'reasonText' => 'no power'
                    ]
                ],
                [
                    'deviceId' => 'F12HJ',
                    'eventDate' => 1710353477,
                    'type' => 'temperatureExceeded',
                    'evtData' => [
                        'temp' => 10.3,
                        'treshold' => 8.5
                    ]
                ],
                [
                    'deviceId' => 'D12-1-12',
                    'eventDate' => 1710352477,
                    'type' => 'doorUnlocked',
                    'evtData' => [
                        'unlockDate' => 1710350477
                    ]
                ]
            ]
        ]);
    }

    // There was an spelling error in PDF (mulfunction)
    #[Route('/events/device-malfunctions', name: 'api_devices_events_deviceMalfunctions_create', methods: ['POST'])]
    public function eventsDeviceMalfunctionsCreate(Request $request): JsonResponse
    {
        // If we would like to add additional logics after processing device event,
        // just add 'afterSuccess' callable
        return $this->processRequest(
            request: $request,
            entityClass: DeviceMalfunctionEvent::class,
            formClass: DeviceMalfunctionEventType::class,
            dispatchedMessage: SendDeviceMalfunctionEmailCommand::class,
        );
    }

    #[Route('/events/doors-unlocked', name: 'api_devices_events_doorsUnlocked_create', methods: ['POST'])]
    public function eventsDoorsUnlockedCreate(Request $request): JsonResponse
    {
        return $this->processRequest(
            request: $request,
            entityClass: DoorUnlockedEvent::class,
            formClass: DoorUnlockedEventType::class,
            dispatchedMessage: SendDoorUnlockedSmsCommand::class,
        );
    }

    #[Route('/events/temperatures-exceeded', name: 'api_devices_events_temperaturesExceeded_create', methods: ['POST'])]
    public function eventsTemperaturesExceededCreate(Request $request): JsonResponse
    {
        return $this->processRequest(
            request: $request,
            entityClass: TemperatureExceededEvent::class,
            formClass: TemperatureExceededEventType::class,
            dispatchedMessage: SendTemperatureExceededRestApiRequestCommand::class,
        );
    }

    private function processRequest(
        Request $request, 
        string $entityClass, 
        string $formClass, 
        ?string $dispatchedMessage,
        ?callable $afterSuccess
    ): JsonResponse {
        $deviceEvent = new $entityClass();
        $form = $this->createForm($formClass, $deviceEvent);
        $form->submit(json_decode($request->getContent(), true));
        
        if ($form->isSubmitted() && $form->isValid()) {
            if (isset($dispatchedMessage)) {
                $this->logAndDispatchMessage($deviceEvent, $dispatchedMessage);
            }
            if (isset($afterSuccess)) {
                $afterSuccess($deviceEvent);
            }

            return $this->json($deviceEvent);
        }

        return $this->json([
            'errors' => $this->getFormErrorsAsArray($form),
        ], 400);
    }

    private function getFormErrorsAsArray(FormInterface $form): array
    {
        $formErrors = $form->getErrors(true);
        $errorsArray = [];
        foreach ($formErrors as $error) {
            $originName = $error->getOrigin()->getName();
            $errorsArray[$originName] ??= $error->getMessage();
        }

        return $errorsArray;
    }

    // I know, method with 'and', but it serves purpose well and simplifies things.
    // Too little components may make interface more complex. Here we have one method call instead of two.
    private function logAndDispatchMessage(DeviceEvent $deviceEvent, string $messageClass): void
    {
        echo 'LOG DEVICE EVENT' . PHP_EOL;

        $this->commandBus->dispatch(
            new $messageClass(
                (new ObjectNormalizer())->normalize($deviceEvent)
            )
        );
    }
}
