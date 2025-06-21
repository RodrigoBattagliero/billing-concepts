<?php

namespace App\Controller;

use App\Entity\IvaApplication;
use App\Form\IvaApplicationForm;
use App\Repository\IvaApplicationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/iva-application')]
final class IvaApplicationController extends AbstractController
{
    #[Route(name: 'app_iva_application_index', methods: ['GET'])]
    public function index(IvaApplicationRepository $ivaApplicationRepository): Response
    {
        return $this->render('iva_application/index.html.twig', [
            'iva_applications' => $ivaApplicationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_iva_application_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request, 
        EntityManagerInterface $entityManager,
        
    ): Response
    {
        $ivaApplication = new IvaApplication();
        $form = $this->createForm(IvaApplicationForm::class, $ivaApplication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ivaApplication);
            $entityManager->flush();

            return $this->redirectToRoute('app_iva_application_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('iva_application/new.html.twig', [
            'iva_application' => $ivaApplication,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_iva_application_show', methods: ['GET'])]
    public function show(IvaApplication $ivaApplication): Response
    {
        return $this->render('iva_application/show.html.twig', [
            'iva_application' => $ivaApplication,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_iva_application_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, IvaApplication $ivaApplication, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(IvaApplicationForm::class, $ivaApplication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_iva_application_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('iva_application/edit.html.twig', [
            'iva_application' => $ivaApplication,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_iva_application_delete', methods: ['POST'])]
    public function delete(Request $request, IvaApplication $ivaApplication, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ivaApplication->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($ivaApplication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_iva_application_index', [], Response::HTTP_SEE_OTHER);
    }
}
