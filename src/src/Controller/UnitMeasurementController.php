<?php

namespace App\Controller;

use App\Entity\UnitMeasurement;
use App\Form\UnitMeasurementForm;
use App\Repository\UnitMeasurementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/unit-measurement')]
final class UnitMeasurementController extends AbstractController
{
    #[Route(name: 'app_unit_measurement_index', methods: ['GET'])]
    public function index(UnitMeasurementRepository $unitMeasurementRepository): Response
    {
        return $this->render('unit_measurement/index.html.twig', [
            'unit_measurements' => $unitMeasurementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_unit_measurement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $unitMeasurement = new UnitMeasurement();
        $form = $this->createForm(UnitMeasurementForm::class, $unitMeasurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($unitMeasurement);
            $entityManager->flush();

            return $this->redirectToRoute('app_unit_measurement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('unit_measurement/new.html.twig', [
            'unit_measurement' => $unitMeasurement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_unit_measurement_show', methods: ['GET'])]
    public function show(UnitMeasurement $unitMeasurement): Response
    {
        return $this->render('unit_measurement/show.html.twig', [
            'unit_measurement' => $unitMeasurement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_unit_measurement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UnitMeasurement $unitMeasurement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UnitMeasurementForm::class, $unitMeasurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_unit_measurement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('unit_measurement/edit.html.twig', [
            'unit_measurement' => $unitMeasurement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_unit_measurement_delete', methods: ['POST'])]
    public function delete(Request $request, UnitMeasurement $unitMeasurement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$unitMeasurement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($unitMeasurement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_unit_measurement_index', [], Response::HTTP_SEE_OTHER);
    }
}
