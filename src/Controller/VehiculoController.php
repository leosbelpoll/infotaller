<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Vehiculo;
use App\Entity\File;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\JsonResponse;

class VehiculoController extends Controller
{

    private $idioma = 'Spanish';

    /**
     * @Route("/cars", name="coches")
     */
    public function cochesAction(Request $request, $vehiculo = null, $apartado = null)
    {
        if($vehiculo != null){
            $em = $this->getDoctrine()->getManager('despiece');
            $archivos = $this->getArchivos($vehiculo, $request->getLocale());
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
            $em = $this->getDoctrine()->getManager('despiece');
            $archivos = $this->getArchivos($vehiculo, $request->getLocale());
            $archivos['clase_vehiculo'] = 'Motocicleta';
            if ($apartado == -1) {
                if (count($archivos['imagenes']) > 0) {
                    $apartado = 0;
                } else if (count($archivos['manualesTaller']) > 0) {
                    $apartado = 1;
                } else if (count($archivos['manualesUsuario']) > 0) {
                    $apartado = 2;
                } else if (count($archivos['esquemasElectricos']) > 0) {
                    $apartado = 3;
                } else if (count($archivos['despieces']) > 0) {
                    $apartado = 4;
                } else if (count($archivos['videos']) > 0) {
                    $apartado = 5;
                } else if (count($archivos['catalogos']) > 0) {
                    $apartado = 6;
                } else if ($archivos['fichaTecnica'] != null) {
                    $apartado = 7;
                } 
            }
            $archivos['apartado'] = $apartado;
            $vehiculoObj = $em->getRepository('App:Vehiculo')->findOneById($vehiculo);
            
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

        $em = $this->getDoctrine()->getManager('despiece');
        if ($vehiculo != null) {
            $vehiculos = $em->getRepository('App:Vehiculo')->findAllPorClase($clase);
            foreach($vehiculos as $v){
                if(!in_array($v->getMarca(), $marcas)){
                    $marcas[] = $v->getMarca();
                }
            }
            $vehiculoObj = $em->getRepository('App:Vehiculo')->findOneById($vehiculo);
            $tipos = $em->getRepository('App:Vehiculo')->findTiposPorMarca($vehiculoObj->getMarca()->getId());
            $modelosObj = $em->getRepository('App:Vehiculo')->findModelosPorTipo($vehiculoObj->getTipo()->getId());
            foreach($modelosObj as $v){
                $modelos[] = $v['modelo'];
            }
            $annosObj = $em->getRepository('App:Vehiculo')->findAnnosPorModelo($vehiculoObj->getModelo());
            foreach($annosObj as $v){
                $annos[] = $v['fechaInicio'];
            }
        } else {
            $vehiculos = $em->getRepository('App:Vehiculo')->findAllPorClase($clase);

            foreach($vehiculos as $v){
                if(!in_array($v->getMarca(), $marcas)){
                    $marcas[] = $v->getMarca();
                }
                if(!in_array($v->getTipo(), $tipos)){
                    $tipos[] = $v->getTipo();
                }
                if(!in_array($v->getModelo(), $modelos)){
                    $modelos[] = $v->getModelo();
                }   
                if(!in_array($v->getCreacion()->format('Y'), $annos)){
                    $annos[] = $v->getFechaInicio();
                }
            }
        }
        

        return $this->render('vehiculo/filtro.html.twig', [
            'marcas' => $marcas,
            'tipos' => $tipos,
            'modelos' => $modelos,
            'annos' => $annos,
            'vehiculo' => $vehiculo,
        ]);
    }

    /**
     * @Route("/direct-vehicles/{vehiculo}/{apartado}", name="busquedaDirectaVehiculo")
     */
    public function busquedaDirectaAction(Request $request, $vehiculo, $apartado)
    {
        $em = $this->getDoctrine()->getManager('despiece');
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

        $em = $this->getDoctrine()->getManager('despiece');
        $vehiculo = $em->getRepository('App:Vehiculo')->findPorFiltro($marca, $tipo, $modelo, $anno);

        $archivos = $this->getArchivos($vehiculo, $request->getLocale());
        return $this->render('vehiculo/detalles.html.twig', $archivos);
    }

    /**
     * @Route("/created-vehicles/{tiempo}", name="vehiculosSubidos")
     */
    public function vehiculosSubidosAction(Request $request, $tiempo)
    {
        $em = $this->getDoctrine()->getManager('despiece');
        $vehiculos = [];
        $vehiculosObj = $em->getRepository('App:Vehiculo')->findVehiculosSubidos($tiempo);

        foreach($vehiculosObj as $vehiculo){
            $aux['datos'] = $vehiculo;
            $aux['archivos'] = $this->getArchivos($vehiculo, $request->getLocale());

            $vehiculos[] = $aux;
        }

        return $this->render('vehiculo/tabla.html.twig', ['vehiculos' => $vehiculos]);
    }

    /**
     * @Route("/updated-vehicles/{tiempo}", name="vehiculosActualizados")
     */
    public function vehiculosActualizadosAction(Request $request, $tiempo)
    {
        $em = $this->getDoctrine()->getManager('despiece');
        $vehiculos = [];
        $vehiculosObj = $em->getRepository('App:Vehiculo')->findVehiculosActualizados($tiempo);

        foreach($vehiculosObj as $vehiculo){
            $aux['datos'] = $vehiculo;
            $aux['archivos'] = $this->getArchivos($vehiculo, $request->getLocale());

            $vehiculos[] = $aux;
        }

        return $this->render('vehiculo/tabla.html.twig', ['vehiculos' => $vehiculos]);
    }

    public function getArchivos($vehiculos, $locale){
        $imagenes = [];
        $manualesTaller = [];
        $manualesUsuario = [];
        $esquemasElectricos = [];
        $despieces = [];
        $videos = [];
        $catalogos = [];
        $fichaTecnica = null;

        if(!$vehiculos){
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

        $em = $this->getDoctrine()->getManager('despiece');
        $archivos = $em->getRepository('App:File')->findAllPorVehiculo($vehiculos);
        
        if(!is_array($vehiculos)){
            $fichaTecnica = $em->getRepository('App:Fcoches')->findOneBy([
                'vehiculo' => $vehiculos,
                'idioma' => $this->getIdioma($locale)
            ]);
        }

        foreach ($archivos as $archivo) {
            $posExtensionPint = strpos($archivo->getName(), '.');
            $ext = substr($archivo->getName(), $posExtensionPint + 1);

            $archivo->type = 'doc';
            
            if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'psd', 'tiff', 'tga', 'tif'])) {
                $archivo->type = 'img';
            }

            if (in_array(strtolower($ext), ['webm', 'mkv', 'flv', 'vob', 'ogv', 'ogg', 'gif', 'avi', 'mov', 'wmv', 'rmvb', 'mp4', 'mpg', 'mpeg', 'm2v', '3gp'])) {
                $archivo->type = 'video';
            }
            
            if ($archivo->getTipo() === 'Video' && strpos($archivo->getName(), 'url#') !== false) {
                $archivo->type = 'videoUrl';
                $archivo->setName(substr($archivo->getName(), 4));
            }
            
            if (strpos($archivo->getName(), 'local#') !== false) {
                $archivo->setName(substr($archivo->getName(), 6));
            }
            
            $posSlash = strpos($archivo->getName(), '/');
            if ($posSlash === false) {
                $archivo->setName('uploads/' . $archivo->getName());
            }
            
            switch ($archivo->getTipo()) {
                case 'Imágenes':
                    $imagenes[] = $archivo;
                    break;
                case 'Manuales taller':
                    $manualesTaller[$archivo->getIdioma()][] = $archivo;
                    break;
                case 'Manual usuario':
                    $manualesUsuario[$archivo->getIdioma()][] = $archivo;
                    break;
                case 'Esquema eléctrico':
                    $esquemasElectricos[$archivo->getIdioma()][] = $archivo;
                    break;
                case 'Despiece':
                    $despieces[$archivo->getIdioma()][] = $archivo;
                    break;
                case 'Video':
                    $videos[$archivo->getIdioma()][] = $archivo;
                    break;
                case 'Catálogo':
                    $catalogos[$archivo->getIdioma()][] = $archivo;
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

    /**
     * @Route("/get-types-by-mark", name="buscarTiposPorMarca")
     */
    public function buscarTiposPorMarca(Request $request){
        $em = $this->getDoctrine()->getManager('despiece');
        $marca = $request->request->get('marca');
        $vehiculos = $em->getRepository('App:Vehiculo')->findTiposPorMarca($marca);

        return new JsonResponse($vehiculos);
    }

    /**
     * @Route("/get-models-by-type", name="buscarModelosPorTipo")
     */
    public function buscarModelosPorTipo(Request $request){
        $em = $this->getDoctrine()->getManager('despiece');
        $tipo = $request->request->get('tipo');
        $vehiculos = $em->getRepository('App:Vehiculo')->findModelosPorTipo($tipo);

        return new JsonResponse($vehiculos);
    }

    /**
     * @Route("/get-years-by-model", name="buscarAnnosPorModelo")
     */
    public function buscarAnnosPorModelo(Request $request){
        $em = $this->getDoctrine()->getManager('despiece');
        $modelo = $request->request->get('modelo');
        $vehiculos = $em->getRepository('App:Vehiculo')->findAnnosPorModelo($modelo);

        return new JsonResponse($vehiculos);
    }

    private function getIdioma($locale = 'es') {
        switch ($locale) {
            case 'es':
                return 'Spanish';
            case 'en':
                return 'English';
            case 'fr':
                return 'Francés';
            case 'pt':
                return 'Portugués';
            case 'al':
                return 'Alemán';
            case 'ca':
                // TODO: cuando se annada el idioma de catalan al trabajo de ficha se retorna aqui en vez de espannol
                return 'Spanish';
                // return 'Catalán';
            default:
                return 'Spanish';
        }
    }
}
