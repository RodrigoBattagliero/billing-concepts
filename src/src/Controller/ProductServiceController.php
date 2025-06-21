<?php

namespace App\Controller;

use App\Entity\ProductService;
use App\Form\ProductServiceForm;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProductServiceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/product-service')]
final class ProductServiceController extends AbstractController
{
    #[Route(name: 'app_product_service_index', methods: ['GET'])]
    public function index(ProductServiceRepository $productServiceRepository): Response
    {
        return $this->render('product_service/index.html.twig', [
            'product_services' => $productServiceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_product_service_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $productService = new ProductService();
        $form = $this->createForm(ProductServiceForm::class, $productService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entityManager->persist($productService);
                $entityManager->flush();

                $this->addFlash('success', 'Concepto de facturación creado correctamente.');

                return $this->redirectToRoute('app_product_service_index', [], Response::HTTP_SEE_OTHER);
            } catch (UniqueConstraintViolationException $e) {
                $form->get('code')
                    ->addError(new FormError('Este código ya está en uso. Por favor, elige otro.'));
            }
        }

        return $this->render('product_service/new.html.twig', [
            'product_service' => $productService,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_service_show', methods: ['GET'])]
    public function show(ProductService $productService): Response
    {
        return $this->render('product_service/show.html.twig', [
            'product_service' => $productService,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_service_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProductService $productService, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductServiceForm::class, $productService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Concepto de facturación editado correctamente.');

            return $this->redirectToRoute('app_product_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product_service/edit.html.twig', [
            'product_service' => $productService,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_service_delete', methods: ['POST'])]
    public function delete(Request $request, ProductService $productService, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productService->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($productService);
            $entityManager->flush();

            $this->addFlash('success', 'Concepto de facturación elimnado correctamente.');

        }

        return $this->redirectToRoute('app_product_service_index', [], Response::HTTP_SEE_OTHER);
    }
}
