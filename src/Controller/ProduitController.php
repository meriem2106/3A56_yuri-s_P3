<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/produit')]
class ProduitController extends AbstractController
{
    
    #[Route('/test', name: 'app_test')]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('FrontOffice/produit/index1.html.twig', [
            'controller_name' => 'ProduitController',
            'produits' => $produitRepository->findAll(),
        ]);
    }

    #[Route("/Colaboration", name:'test_page')]
     
    public function testPage(): Response
    {
        return $this->render('FrontOffice/test.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
        
    }
   
    // #[Route('/', name: 'app_produit_index', methods: ['GET'])]
    // public function index1(ProduitRepository $produitRepository): Response
    // {
    //     return $this->render('produit/index.html.twig', [
    //         'produits' => $produitRepository->findAll(),
    //     ]);
    // }
    #[Route('/', name: 'app_produit_index', methods: ['GET'])]
    public function indexe(ProduitRepository $produitRepository, PaginatorInterface $paginator, Request $request): Response
    {
        
        $data = $produitRepository->findAll();
        
        $produits = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6   // Nombre d'éléments par page
        );
    
        return $this->render('BackOffice/produit/index.html.twig', [
            'produits' => $produits,
        ]);
    }
    #[Route('/new', name: 'app_produit_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager,FileUploader $fileUploader): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Check if a product with the same name already exists
            $existingProduit = $entityManager->getRepository(Produit::class)->findOneBy(['nom' => $produit->getNom()]);
 
     
            if ($existingProduit) {
                $this->addFlash('danger', 'Un produit avec le même nom existe déjà.');
                // You can also pass the existing product ID to redirect to its details page or handle it as needed
                
                return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
            }
    
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $imageFileName = $fileUploader->upload($imageFile);
                $produit->setImage($imageFileName);
            }
    
            $entityManager->persist($produit);
            $entityManager->flush();
    
            $this->addFlash('success', 'Le produit a été ajouté avec succès.');
    
            return $this->redirectToRoute('app_test', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('FrontOffice/produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }
   
    #[Route('/{id}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('BackOffice/produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }
    #[Route('front/{id}', name: 'app_produit_showf', methods: ['GET'])]
    public function showf(Produit $produit): Response
    {
        return $this->render('FrontOffice/produit/showf.html.twig', [
            'produit' => $produit,
        ]);
    }
   

   #[Route('/{id}/edit', name: 'app_produit_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
{
    $form = $this->createForm(ProduitType::class, $produit);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();
        
        // Ajouter un message flash de succès
        $this->addFlash('success', 'Le produit a été modifié avec succès.');

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('FrontOffice/produit/edit.html.twig', [
        'produit' => $produit,
        'form' => $form,
    ]);
}


    #[Route('/{id}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}
