<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class FileController extends Controller
{
    /**
     * Encontrar la primera imagen del vehiculo
     *  actualmente se usa para mostrar el thumb en la tabla de la portada
     */
    public function findImagenVehiculoAction($vehiculo)
    {
        $em = $this->getDoctrine()->getManager('despiece');
        $file = $em->getRepository('App:File')->findImagenVehiculo($vehiculo);
        if($file){
            return new Response($file[0]->getName());
        }

        return new Response('');
    }
}
