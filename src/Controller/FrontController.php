<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controlador de las vistas
 */

class FrontController extends AbstractController
{
    private $mailer;

    // Inyecto el Swift_Mailer para poder usarlo cuando lo necesite
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
     * Este metodo recibe el grupo y la pagina del programa
     *  - si no llega ninguno renderizo la plantilla general de programas
     *  - si llega solo el grupo renderizo el primero de los menus
     *  - si llegan los dos intento renderizar la vista que esta en la carpeta de programas/grupo/pagina
     *      - si no lo encuentra renderizo una vista explicando lo que hay que hacer para agregar ese nuevo programa
     *
     * 
     * @Route("/program/{grupo}/{pagina}", name="program", defaults={"grupo": null, "pagina": null})
     */
    public function programaAction(Request $request, $grupo = null, $pagina = null)
    {
        if(!$grupo and !$pagina){
            return $this->render('layout/programa.html.twig', []);
        }

        if (!$pagina) {
            switch ($grupo) {
                case "configuracion":
                    $pagina = "registro_vehiculos";
                    break;
                case "archivos":
                    $pagina = "clientes";
                    break;
                case "facturacion":
                    $pagina = "factura";
                    break;
                case "herramientas":
                    $pagina = "calendario";
                    break;
            }
            // Si quiere renderizar solo la plantilla del programa especifico invierta la ejecucion de las siguientes dos lineas
            // return $this->render('layout/programa/' . $grupo . '.html.twig', []);
            return $this->redirect($this->generateUrl('program', ['grupo'=>$grupo, 'pagina'=>$pagina]));
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
     * Metodo para enviar emails
     * 
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
        }

        return new Response();
    }

    /**
     * Metodo auxiliar para enviar el email
     */
    private function enviarEmail($asunto, $to, $body)
    {
        $mensaje = (new \Swift_Message($asunto))
                ->setFrom([$_ENV['MAILER'] => 'Despiece App'])
                ->setTo($to)
                ->setBody($body, 'text/html');

        $this->mailer->send($mensaje);
    }
}
