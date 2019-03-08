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

        $em = $this->getDoctrine()->getManager('despiece');
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
            
            if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'psd', 'tiff', 'tga'])) {
                $archivo->type = 'img';
            }

            if (in_array(strtolower($ext), ['webm', 'mkv', 'flv', 'vob', 'ogv', 'ogg', 'gif', 'avi', 'mov', 'wmv', 'rmvb', 'mp4', 'mpg', 'mpeg', 'm2v', '3gp'])) {
                $archivo->type = 'img';
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
                return 'Frances';
            case 'pt':
                return 'Portugues';
            case 'ca':
                return 'Catala';
            default:
                return 'Spanish';
        }
    }
}
