<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{

    public function verificarIdiomaAction(Request $request)
    {
//        $user = $this->getUser();
//
//        if ($user != null) {
//            if ($user->getIdioma() != null) {
//                return $this->redirect($this->generateUrl('portada.' . $user->getIdioma()));
//            }
//        }
        if ($request->getLanguages() != null) {
            $idiomaPreferidoNavegador = substr($request->getLanguages()[0], 0, 2);
            if (in_array($idiomaPreferidoNavegador, ['es', 'en', 'ca', 'fr', 'pt'])) {
                return $this->redirect($this->generateUrl('portada.' . $idiomaPreferidoNavegador));
            }
        }
        return $this->redirect($this->generateUrl('portada.en'));
    }

    /**
     * @Route("/change-language/{ruta}/{locale}", name="cambiar_idioma_usuario")
     */
    public function cambiarIdiomaAction(Request $request, $ruta, $locale)
    {
        if (!in_array($locale, ['es', 'en', 'ca', 'fr', 'pt'])) {
            throw new \Exception('appdespiece.excepcion.locale.no.encontrado');
        }
        $session = new Session();
        $session->set('_locale', $locale);
        
        $newRuta = str_replace("**", "/", $ruta);

        return $this->redirect($newRuta);
    }

}
