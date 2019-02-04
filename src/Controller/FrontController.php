<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="portada")
     */
    public function index(Request $request)
    {
        $locale = $request->getLocale();
        // dump($locale);
        // die;
        $request->setLocale('es');
        // dump($request->getLocale());
        // die;
        return $this->render('front/index.html.twig', [
            'locale' => 'es',
            'controller_name' => 'FrontController',
        ]);
    }
    /**
     * @Route("/", name="coches")
     */
    public function coches()
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/", name="motos")
     */
    public function motos()
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
    /**
     * @Route("/", name="programa")
     */
    public function programa()
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
    /**
     * @Route("/", name="cambiar_idioma_usuario")
     */
    public function cambiar_idioma_usuario()
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }
    /**
     * @Route("/", name="crear_email")
     */
    public function crear_email()
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('front/contact.html.twig', []);
    }
}
