<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Controlador para el manejo del idioma del usuario
 * Este controlador no se encarga de manejar los usuarios ya que el bundle FOSUserBundle es quien lo hace 
 */

class UserController extends Controller
{

    public function verificarIdiomaAction(Request $request)
    {
        // Si llega un idioma preferido del navegador en la peticion 
        if ($request->getLanguages() != null) {
            $idiomaPreferidoNavegador = substr($request->getLanguages()[0], 0, 2);

            // Si el idioma preferido es alguno de los idiomas en que esta desarrollada la aplicacion, renderizo con ese idima
            if (in_array($idiomaPreferidoNavegador, ['es', 'en', 'ca', 'fr', 'pt'])) {
                return $this->redirect($this->generateUrl('portada.' . $idiomaPreferidoNavegador));
            }
        }

        // Si no llega idioma renderizo usando el idioma ingles
        return $this->redirect($this->generateUrl('portada.en'));
    }

    /**
     * Metodo para cambiar el idioma del usuario
     * 
     * @Route("/change-language/{ruta}/{locale}", name="cambiar_idioma_usuario")
     */
    public function cambiarIdiomaAction(Request $request, $ruta, $locale)
    {
        // Si el idioma de la peticion no es ninguno de los desarrollados para la aplicacion se lanza una exepcion
        if (!in_array($locale, ['es', 'en', 'ca', 'fr', 'pt'])) {
            throw new \Exception('appdespiece.excepcion.locale.no.encontrado');
        }

        // Si es de los soportados entonces, se modifica la session del usuario y se recarga usando el nuevo idioma
        $session = new Session();
        $session->set('_locale', $locale);
        
        $newRuta = str_replace("**", "/", $ruta);

        return $this->redirect($newRuta);
    }

}
