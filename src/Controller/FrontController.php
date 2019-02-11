<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Utils\Mail;

class FrontController extends AbstractController
{
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
    
    /**
     * @Route("/", name="portada")
     */
    public function portada(Request $request)
    {
        return $this->render('front/portada.html.twig', [
            'locale' => 'es',
            'controller_name' => 'FrontController',
        ]);
    }
    
    /**
     * @Route("/program/{grupo}/{pagina}", name="program", defaults={"grupo": null, "pagina": null})
     */
    public function programaAction(Request $request, $grupo = null, $pagina = null)
    {
        if(!$grupo and !$pagina){
            return $this->render('layout/programa.html.twig', []);
        }

        if (!$pagina) {
            return $this->render('layout/programa/' . $grupo . '.html.twig', []);
        }
        try{
            return $this->render('programa/' . $grupo . '/' . $pagina . '.html.twig', []);
        } catch (\Exception $e) {
            return $this->render('programa/template_not_found.html.twig', [
                'grupo' => $grupo,
                'pagina' => $pagina
            ]);
        }
    }

    /**
     * @Route("/create_email", name="crear_email")
     */
    public function crearEmailAction(Request $request)
    {
        switch ($request->get('tipo_email')) {
            case 'contacto':
                if ($request->get('verificacion_robots')){
                    throw new \Exception('appdespiece.excepcion.robots');
                }

                if (!$request->get('nombre_contacto') || !$request->get('titulo_contacto') || !$request->get('mensaje_contacto')) {
                    throw new \Exception('appdespiece.introduzca.datos.formulario');
                }

                $email_html = $this->get('twig')->render('email/contacto.html.twig', [
                        'nombre' => $request->get('nombre_contacto'),
                        'titulo' => $request->get('titulo_contacto'),
                        'mensaje' => $request->get('mensaje_contacto'),
                ]);

                $this->enviarEmail('Contacto', $request->get('para_contacto'), $email_html);
                break;
            case 'publicidad':
                if (!$request->get('nombre_publicidad') || !$request->get('email_publicidad') || !$request->get('mensaje_publicidad')) {
                    throw new \Exception('appdespiece.introduzca.datos.formulario');
                }

                $email_html = $this->get('twig')->render('email/publicidad.html.twig', [
                        'nombre' => $request->get('nombre_publicidad'),
                        'email' => $request->get('email_publicidad'),
                        'mensaje' => $request->get('mensaje_publicidad'),
                ]);

                $this->enviarEmail('Publicidad', $request->get('para_contacto'), $email_html);
                break;
        }

        return new Response();
    }

    private function enviarEmail($asunto, $to, $body)
    {
        $mensaje = (new \Swift_Message($asunto))
                ->setFrom([$_ENV['MAILER'] => 'Despiece App'])
                ->setTo($to)
                ->setBody($body, 'text/html');

        $this->mailer->send($mensaje);
    }
}
