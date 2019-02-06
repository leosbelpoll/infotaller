<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Vehiculo;
use App\Entity\File;
use Symfony\Component\Validator\Constraints\DateTime;

class VehiculoController extends Controller
{
    /**
     * @Route("/cars", name="coches")
     */
    public function cochesAction(Request $request, $vehiculo = null, $apartado = null)
    {
        if($vehiculo != null){
            $em = $this->getDoctrine()->getManager();
            $archivos = $this->getArchivos($vehiculo);
            $archivos['clase_vehiculo'] = 'Coche';
            $archivos['apartado'] = $apartado;
            $vehiculoObj = $em->getRepository('App:Vehiculo')->findCoche($vehiculo);

            if(!$vehiculoObj){
                throw $this->createNotFoundException('appdespiece.vehiculo.no.encontrado');
            }

            $archivos['vehiculo'] = $vehiculoObj;
            return $this->render('vehiculo/index.html.twig', $archivos);
        }

        return $this->render('vehiculo/index.html.twig', [
            'clase_vehiculo' => 'Coche'
        ]);
    }

    /**
     * @Route("/motos/{vehiculo}/{apartado}", name="motos")
     */
    public function motosAction(Request $request, $vehiculo = null, $apartado = null)
    {
        if($vehiculo != null){
            $em = $this->getDoctrine()->getManager();
            $archivos = $this->getArchivos($vehiculo);
            $archivos['clase_vehiculo'] = 'Motocicleta';
            $archivos['apartado'] = $apartado;
            $vehiculoObj = $em->getRepository('App:Vehiculo')->findMoto($vehiculo);
            
            if(!$vehiculoObj){
                throw $this->createNotFoundException('appdespiece.vehiculo.no.encontrado');
            }

            $archivos['vehiculo'] = $vehiculoObj;
            return $this->render('vehiculo/index.html.twig', $archivos);
        }

        return $this->render('vehiculo/index.html.twig', [
            'clase_vehiculo' => 'Motocicleta'
        ]);
    }

    public function filtroAction($clase, $vehiculo = null)
    {
        $marcas = [];
        $tipos = [];
        $modelos = [];
        $annos = [];

        $em = $this->getDoctrine()->getManager();
        $vehiculos = $em->getRepository('App:Vehiculo')->findAllPorClase($clase);
        if($vehiculo){
            $vehiculoObj = $em->getRepository('App:Vehiculo')->find($vehiculo);
            
            if(!$vehiculoObj){
                throw $this->createNotFoundException('appdespiece.vehiculo.no.encontrado');
            }
        }

        foreach($vehiculos as $v){
            if(!in_array($v->getMarca(), $marcas)){
                if($vehiculo){
                    if($vehiculoObj->getMarca() !== $v->getMarca()){
                        $marcas[] = $v->getMarca();
                    }
                }else{
                    $marcas[] = $v->getMarca();
                }
            }
            if(!in_array($v->getTipo(), $tipos)){
                if($vehiculo){
                    if($vehiculoObj->getTipo() != $v->getTipo()){
                        $tipos[] = $v->getTipo();
                    }
                }else{
                    $tipos[] = $v->getTipo();
                }
            }
            if(!in_array($v->getModelo(), $modelos)){
                if($vehiculo){
                    if($vehiculoObj->getModelo() != $v->getModelo()){
                        $modelos[] = $v->getModelo();
                    }
                }else{
                    $modelos[] = $v->getModelo();
                }
            }   
            if(!in_array($v->getCreacion()->format('Y'), $annos)){
                if($vehiculo){
                    if($vehiculoObj->getCreacion()->format('Y') != $v->getCreacion()->format('Y')){
                        $annos[] = $v->getCreacion()->format('Y');
                    }
                }else{
                    $annos[] = $v->getCreacion()->format('Y');
                }
            }
        }


        if($vehiculo != null){
            $vehiculoObj = $em->getRepository('App:Vehiculo')->find($vehiculo);

            if(!$vehiculoObj){
                throw $this->createNotFoundException('appdespiece.vehiculo.no.encontrado');
            }

            return $this->render('vehiculo/filtro.html.twig', [
                'marcas' => $marcas,
                'tipos' => $tipos,
                'modelos' => $modelos,
                'annos' => $annos,
                'vehiculo'  => $vehiculoObj
        ]);
        }

        return $this->render('vehiculo/filtro.html.twig', [
            'marcas' => $marcas,
            'tipos' => $tipos,
            'modelos' => $modelos,
            'annos' => $annos,
        ]);
    }

    /**
     * @Route("/direct-vehicles/{vehiculo}/{apartado}", name="busquedaDirectaVehiculo")
     */
    public function busquedaDirectaAction(Request $request, $vehiculo, $apartado)
    {
        $em = $this->getDoctrine()->getManager();
        $vehiculoObj = $em->getRepository('App:Vehiculo')->find($vehiculo);

        if(!$vehiculoObj){
            throw $this->createNotFoundException('appdespiece.vehiculo.no.encontrado');
        }

        $ruta = 'portada';
        switch($vehiculoObj->getClase()->getName()){
            case 'Motocicleta':
                $ruta = 'motos';
                break;
            case 'Coche':
                $ruta = 'coches';
                break;
        }

        return $this->redirect($this->generateUrl($ruta, array(
            'vehiculo'=>$vehiculo,
            'apartado'=>$apartado
        )));
    }

    /**
     * @Route("/search-vehicles", name="busquedaVehiculos")
     */
    public function busquedaAction(Request $request)
    {
        $marca = $request->get('marca_vehiculo');
        $tipo = $request->get('tipo_vehiculo');
        $modelo = $request->get('modelo_vehiculo');
        $anno = $request->get('anno_vehiculo');

        $em = $this->getDoctrine()->getManager();
        $vehiculo = $em->getRepository('App:Vehiculo')->findPorFiltro($marca, $tipo, $modelo, $anno);

        $archivos = $this->getArchivos($vehiculo);
        return $this->render('vehiculo/detalles.html.twig', $archivos);
    }

    /**
     * @Route("/created-vehicles    ", name="vehiculosSubidos")
     */
    public function vehiculosSubidosAction(Request $request, $tiempo)
    {
        $em = $this->getDoctrine()->getManager();
        $vehiculos = [];
        $vehiculosObj = $em->getRepository('App:Vehiculo')->findVehiculosSubidos($tiempo);

        foreach($vehiculosObj as $vehiculo){
            $aux['datos'] = $vehiculo;
            $aux['archivos'] = $this->getArchivos($vehiculo->getId());

            $vehiculos[] = $aux;
        }

        return $this->render('vehiculo/tabla.html.twig', ['vehiculos' => $vehiculos]);
    }

    /**
     * @Route("/updated-vehicles    ", name="vehiculosActualizados")
     */
    public function vehiculosActualizadosAction(Request $request, $tiempo)
    {
        $em = $this->getDoctrine()->getManager();
        $vehiculos = [];
        $vehiculosObj = $em->getRepository('App:Vehiculo')->findVehiculosActualizados($tiempo);

        foreach($vehiculosObj as $vehiculo){
            $aux['datos'] = $vehiculo;
            $aux['archivos'] = $this->getArchivos($vehiculo->getId());

            $vehiculos[] = $aux;
        }

        return $this->render('vehiculo/tabla.html.twig', ['vehiculos' => $vehiculos]);
    }

    public function getArchivos($vehiculo){
        $imagenes = [];
        $manualesTaller = [];
        $manualesUsuario = [];
        $esquemasElectricos = [];
        $despieces = [];
        $videos = [];
        $catalogos = [];
        $fichaTecnica = null;

        if(!$vehiculo){
            return array(
                'imagenes'              => $imagenes,
                'manualesTaller'        => $manualesTaller,
                'manualesUsuario'       => $manualesUsuario,
                'esquemasElectricos'    => $esquemasElectricos,
                'despieces'             => $despieces,
                'videos'                => $videos,
                'catalogos'             => $catalogos,
                'fichaTecnica'          => $fichaTecnica
            );
        }

        $em = $this->getDoctrine()->getManager();
        $archivos = $em->getRepository('App:File')->findAllPorVehiculo($vehiculo);
        $fichaTecnica = $em->getRepository('App:Fcoches')->findOneByVehiculo($vehiculo);

        foreach ($archivos as $archivo) {
            switch ($archivo->getTipo()) {
                case 'Imágenes':
                    $imagenes[] = $archivo;
                    break;
                case 'Manuales taller':
                    switch ($archivo->getIdioma()) {
                        case 'English':
                            $manualesTaller['ingles'][] = $archivo;
                            break;
                        case 'Spanish':
                            $manualesTaller['espannol'][] = $archivo;
                            break;
                        case 'French':
                            $manualesTaller['frances'][] = $archivo;
                            break;
                        case 'Catalan':
                            $manualesTaller['catalan'][] = $archivo;
                            break;
                        case 'Portuges':
                            $manualesTaller['portuges'][] = $archivo;
                            break;
                    }
                    break;
                case 'Manual usuario':
                    switch ($archivo->getIdioma()) {
                        case 'English':
                            $manualesUsuario['ingles'][] = $archivo;
                            break;
                        case 'Spanish':
                            $manualesUsuario['espannol'][] = $archivo;
                            break;
                        case 'French':
                            $manualesUsuario['frances'][] = $archivo;
                            break;
                        case 'Catalan':
                            $manualesUsuario['catalan'][] = $archivo;
                            break;
                        case 'Portuges':
                            $manualesUsuario['portuges'][] = $archivo;
                            break;
                    }
                    break;
                case 'Esquema eléctrico':
                    switch ($archivo->getIdioma()) {
                        case 'English':
                            $esquemasElectricos['ingles'][] = $archivo;
                            break;
                        case 'Spanish':
                            $esquemasElectricos['espannol'][] = $archivo;
                            break;
                        case 'French':
                            $esquemasElectricos['frances'][] = $archivo;
                            break;
                        case 'Catalan':
                            $esquemasElectricos['catalan'][] = $archivo;
                            break;
                        case 'Portuges':
                            $esquemasElectricos['portuges'][] = $archivo;
                            break;
                    }
                    break;
                case 'Despiece':
                    switch ($archivo->getIdioma()) {
                        case 'English':
                            $despieces['ingles'][] = $archivo;
                            break;
                        case 'Spanish':
                            $despieces['espannol'][] = $archivo;
                            break;
                        case 'French':
                            $despieces['frances'][] = $archivo;
                            break;
                        case 'Catalan':
                            $despieces['catalan'][] = $archivo;
                            break;
                        case 'Portuges':
                            $despieces['portuges'][] = $archivo;
                            break;
                    }
                    break;
                case 'Video':
                    switch ($archivo->getIdioma()) {
                        case 'English':
                            $videos['ingles'][] = $archivo;
                            break;
                        case 'Spanish':
                            $videos['espannol'][] = $archivo;
                            break;
                        case 'French':
                            $videos['frances'][] = $archivo;
                            break;
                        case 'Catalan':
                            $videos['catalan'][] = $archivo;
                            break;
                        case 'Portuges':
                            $videos['portuges'][] = $archivo;
                            break;
                    }
                    break;
                case 'Catálogo':
                    switch ($archivo->getIdioma()) {
                        case 'English':
                            $catalogos['ingles'][] = $archivo;
                            break;
                        case 'Spanish':
                            $catalogos['espannol'][] = $archivo;
                            break;
                        case 'French':
                            $catalogos['frances'][] = $archivo;
                            break;
                        case 'Catalan':
                            $catalogos['catalan'][] = $archivo;
                            break;
                        case 'Portuges':
                            $catalogos['portuges'][] = $archivo;
                            break;
                    }
                    break;
            }
        }

        return array(
            'imagenes'              => $imagenes,
            'manualesTaller'        => $manualesTaller,
            'manualesUsuario'       => $manualesUsuario,
            'esquemasElectricos'    => $esquemasElectricos,
            'despieces'             => $despieces,
            'videos'                => $videos,
            'catalogos'             => $catalogos,
            'fichaTecnica'          => $fichaTecnica
        );
    }
}
