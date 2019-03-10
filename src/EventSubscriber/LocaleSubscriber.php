<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class LocaleSubscriber implements EventSubscriberInterface
{
    // private $defaultLocale;

    // public function __construct($defaultLocale = 'es')
    // {
    //     $this->defaultLocale = $defaultLocale;
    //     // TODO: fix the right locale
    //     // $this->defaultLocale = $defaultLocale;
    // }

    public function onKernelRequest(GetResponseEvent $event)
    {

        $session = new Session();
        $locale = $session->get('_locale');
        if (!isset($locale)) {
            $locale = 'en';
        }
        $event->getRequest()->setLocale($locale);
    }

    public static function getSubscribedEvents()
    {
        return [
            // must be registered before (i.e. with a higher priority than) the default Locale listener
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }
}