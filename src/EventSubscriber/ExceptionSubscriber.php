<?php
declare(strict_types = 1);

namespace App\EventSubscriber;


use App\Auth\AccessTokenInterface;
use App\Auth\TokenDecoderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    private $tokenDecoder;
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * ExceptionSubscriber constructor.
     * @param TokenDecoderInterface $tokenDecoder
     * @param ContainerInterface $container
     */
    public function __construct(TokenDecoderInterface $tokenDecoder, ContainerInterface $container)
    {
        $this->tokenDecoder = $tokenDecoder;
        $this->container = $container;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * ['eventName' => 'methodName']
     *  * ['eventName' => ['methodName', $priority]]
     *  * ['eventName' => [['methodName1', $priority], ['methodName2']]]
     *
     * The code must not depend on runtime state as it will only be called at compile time.
     * All logic depending on runtime state must be put into the individual methods handling the events.
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [
                ['autorization', 10],

            ],
        ];
    }

    /**
     * @param RequestEvent $event
     */
    public function autorization(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if (!$request->headers->has('Authorization')){
            return;
        }

        $token = $request->headers->get('Authorization');
        //$accessToken = $this->tokenDecoder->decode($token);
        //$this->container->set(AccessTokenInterface::class, $accessToken);
    }

}