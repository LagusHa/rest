<?php
declare(strict_types=1);

namespace App\EventListener;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event) : ExceptionEvent
    {
        $exception = $event->getThrowable();
        $response = new JsonResponse(['error' => $exception->getMessage()]);

        if ($exception instanceof \LogicException){
            $exception = new BadRequestHttpException($exception->getMessage());
        }
        $response->setStatusCode($exception->getStatusCode());
//        $response->setContent(json_encode([
//            'error' => $exception->getMessage()
//        ]));

        $event->setResponse($response);
        return $event;
    }

}