<?php

namespace App\Controller;

use App\Entity\Maison;
use App\Form\MaisonType;
use App\Repository\MaisonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;


#[Route('/maison')]
class MaisonController extends AbstractController
{
    #[Route('/', name: 'app_maison_index', methods: ['GET'])]
    public function index(MaisonRepository $maisonRepository): Response
    {
        return $this->render('maison/index.html.twig', [
            'maisons' => $maisonRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_maison_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $maison = new Maison();
        $form = $this->createForm(MaisonType::class, $maison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Check if a product with the same name already exists
            $existingMaison = $entityManager->getRepository(Maison::class)->findOneBy(['nom' => $maison->getNom()]);

    
            if ($existingMaison) {
                $this->addFlash('danger', 'Une maison d hote avec le même nom existe déjà.');
                // You can also pass the existing product ID to redirect to its details page or handle it as needed
                
                return $this->redirectToRoute('app_maison_index', [], Response::HTTP_SEE_OTHER);
            }
    
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $imageFileName = $fileUploader->upload($imageFile);
                $maison->setImage($imageFileName);
            }
    
            $entityManager->persist($maison);
            $entityManager->flush();
    
            $this->addFlash('success', 'La maison a été ajoutée avec succès.');
    
            return $this->redirectToRoute('app_maison_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('maison/new.html.twig', [
            'maison' => $maison,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_maison_show', methods: ['GET'])]
    public function show(Maison $maison): Response
    {
        return $this->render('maison/show.html.twig', [
            'maison' => $maison,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_maison_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, Maison $maison, EntityManagerInterface $entityManager): Response
{
    $form = $this->createForm(MaisonType::class, $maison);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Inutile de récupérer une nouvelle instance de l'EntityManager ici
        // $entityManager = $this->getDoctrine()->getManager();

        $entityManager->flush();

        return $this->redirectToRoute('app_maison_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('maison/edit.html.twig', [
        'maison' => $maison,
        'form' => $form,
    ]);
}


    #[Route('/{id}', name: 'app_maison_delete', methods: ['POST'])]
    public function delete(Request $request, Maison $maison, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$maison->getId(), $request->request->get('_token'))) {
            $entityManager->remove($maison);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_maison_index', [], Response::HTTP_SEE_OTHER);
    }
}
