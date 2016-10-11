<?php

namespace AppBundle\EventListener;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ValidUserListener
 * @package AppBundle\EventListener
 */
class ValidUserListener
{
    /**
     * @var AnnotationReader
     */
    private $reader;
    /**
     * @var Router
     */
    private $router;
    /**
     * @var Session
     */
    private $session;
    private $tokenStorage;
    /**
     * @var ValidatorInterface
     */
    private $validator;
    private $annotationName = 'AppBundle\Security\Annotation\ValidateUser';

    public function __construct(
      $reader,
      $router,
      $session,
      $tokenStorage,
      $validator
    ) {
        $this->reader = $reader;
        $this->router = $router;
        $this->session = $session;
        $this->tokenStorage = $tokenStorage;
        $this->validator = $validator;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();
        $className = get_class($controller[0]);
        $methodName = $controller[1];

        $method = new \ReflectionMethod(
          $className,
          $methodName
        );

        // Read the annotation.
        $annotation = $this->reader->getMethodAnnotation(
          $method,
          $this->annotationName
        );

        if (!is_null($annotation)) {
            // Recupero il gruppo di validazione dalla annotazione.
            $validationGroup = $annotation->getValidationGroup();

            // Recupero l'utente.
            $user = $this->tokenStorage->getToken()->getUser();

            $errors = $this->validator->validate($user, null, array($validationGroup));

            if(count($errors)) {
                // All'utente non è permesso eseguire questa azione...
                $event->setController(function() {
                    $this->session->getFlashBag()->add('warning', 'Your username don\'t begins with ***\'car\'***');
                    $url = $this->router->generate('fos_user_profile_edit');
                    return new RedirectResponse($url);
                });
            }

        }
    }
}