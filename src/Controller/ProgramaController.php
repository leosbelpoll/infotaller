<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProgramaController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('layout/programa.html.twig', []);
    }

    public function programaArchivosAction(Request $request, $pagina = null)
    {
        if (!$pagina) {
            return $this->render('layout/programa/archivos.html.twig', []);
        } else {
            return $this->render('programa/archivos/' . $pagina . '.html.twig', []);
        }
    }

    public function programaConfiguracionAction(Request $request, $pagina = null)
    {
        if (!$pagina) {
            return $this->render('layout/programa/configuracion.html.twig', []);
        } else {
            return $this->render('programa/configuracion/' . $pagina . '.html.twig', []);
        }
    }

    public function programaFacturacionAction(Request $request, $pagina = null)
    {
        if (!$pagina) {
            return $this->render('layout/programa/facturacion.html.twig', []);
        } else {
            return $this->render('programa/facturacion/' . $pagina . '.html.twig', []);
        }
    }

    public function programaHerramientasAction(Request $request, $pagina = null)
    {
        if (!$pagina) {
            return $this->render('layout/programa/herramientas.html.twig', []);
        } else {
            return $this->render('programa/herramientas/' . $pagina . '.html.twig', []);
        }
    }

    public function programaEstadisticasAction(Request $request, $pagina = null)
    {
        if (!$pagina) {
            return $this->render('layout/programa/estadisticas.html.twig', []);
        } else {
            return $this->render('programa/estadisticas/' . $pagina . '.html.twig', []);
        }
    }

}