<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use GuzzleHttp\Client;

use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\Controller\RegistrationController;



class SecurityController extends Controller
{
    private $registrationController;

    public function __construct(RegistrationController $registrationController)
    {
        $this->registrationController = $registrationController;
    }

    /**
     * @Route("/register/check-recaptcha", name="registerCheckRecaptcha")
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
            return $this->registrationController->registerAction($request);
        }

        throw new \Exception();
    }
}
