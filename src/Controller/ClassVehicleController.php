<?php

namespace App\Controller;

use App\Entity\ClassVehicle;
use App\Form\ClassVehicleType;
use App\Repository\ClassVehicleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/classes")
 */
class ClassVehicleController extends AbstractController
{
    /**
     * @Route("/", name="class_vehicle_index", methods={"GET"})
     */
    public function index(ClassVehicleRepository $classVehicleRepository): Response
    {
        return $this->render('class_vehicle/index.html.twig', [
            'class_vehicles' => $classVehicleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="class_vehicle_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $classVehicle = new ClassVehicle();
        $form = $this->createForm(ClassVehicleType::class, $classVehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($classVehicle);
            $entityManager->flush();

            return $this->redirectToRoute('class_vehicle_index');
        }

        return $this->render('class_vehicle/new.html.twig', [
            'class_vehicle' => $classVehicle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="class_vehicle_show", methods={"GET"})
     */
    public function show(ClassVehicle $classVehicle): Response
    {
        return $this->render('class_vehicle/show.html.twig', [
            'class_vehicle' => $classVehicle,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="class_vehicle_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ClassVehicle $classVehicle): Response
    {
        $form = $this->createForm(ClassVehicleType::class, $classVehicle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('class_vehicle_index', [
                'id' => $classVehicle->getId(),
            ]);
        }

        return $this->render('class_vehicle/edit.html.twig', [
            'class_vehicle' => $classVehicle,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="class_vehicle_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ClassVehicle $classVehicle): Response
    {
        if ($this->isCsrfTokenValid('delete'.$classVehicle->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($classVehicle);
            $entityManager->flush();
        }

        return $this->redirectToRoute('class_vehicle_index');
    }
}
