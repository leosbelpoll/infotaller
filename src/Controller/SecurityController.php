<?php

namespace App\Controller;

use App\Controller\FrontController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\Controller\RegistrationController;

/**
 * Este controlador es especificamente para el recaptcha, ya que el manejo de los usuarios lo hace FOSUserBundle
 */

class SecurityController extends Controller
{
    private $registrationController;
    private $frontController;

    public function __construct(RegistrationController $registrationController, FrontController $frontController)
    {
        $this->registrationController = $registrationController;
        $this->frontController = $frontController;
    }

    /**
     * Envio la peticion a google para saber si el recaptcha es valido
     * 
     * @Route("/check", name="registerCheckRecaptcha")
     */
    public function registerCheckRecaptcha(Request $request)
    {
        $client = new Client();

        $recaptchaResponse = $request->request->get('g-recaptcha-response');
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' => [
                    'secret'   => $_ENV['RECAPTCHA_SERVER'],
                    'response' => $recaptchaResponse,
                ]
            ]
        );
        $result = json_decode($response->getBody(), true);

        if ($result['success']) {
            switch($result['action']){
                case 'contact':
                    return $this->frontController->crearEmailAction($request);
                case 'register':
                    return $this->registrationController->registerAction($request);
                default:
                    throw new \Exception();
            }
            
        }

        throw new \Exception();
    }
}
