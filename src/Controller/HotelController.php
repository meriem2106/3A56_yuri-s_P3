<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\HotelType;
use App\Repository\HotelRepository;
use App\Repository\MaisonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;

#[Route('/hotel')]
class HotelController extends AbstractController
{
    #[Route('/home', name: 'app_first')]
    public function indexa(HotelRepository $hotelRepository, MaisonRepository $maisonRepository): Response
    {
        return $this->render('hotel/index1.html.twig', [
            'controller_name' => 'FirstController',
            'hotels' => $hotelRepository->findAll(),
            'maisons' => $maisonRepository->findAll(),
        ]);
    }

    #[Route("/Collaboration", name:'test_page')]
     
    public function testPage(): Response
    {
        return $this->render('hotel/test.html.twig', [
            'controller_name' => 'HotelController',
        ]);
    }
    #[Route('/', name: 'app_hotel_index', methods: ['GET'])]
    public function index(HotelRepository $hotelRepository): Response
    {
        return $this->render('hotel/index.html.twig', [
            'hotels' => $hotelRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_hotel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $hotel = new Hotel();
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           // Check if a product with the same name already exists
           $existingHotel = $entityManager->getRepository(Hotel::class)->findOneBy(['nom' => $hotel->getNom()]);

    
           if ($existingHotel) {
               $this->addFlash('danger', 'Un hotel avec le même nom existe déjà.');
               // You can also pass the existing product ID to redirect to its details page or handle it as needed
               
               return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
           }
   
           $imageFile = $form->get('image')->getData();
           if ($imageFile) {
               $imageFileName = $fileUploader->upload($imageFile);
               $hotel->setImage($imageFileName);
           }
   
           $entityManager->persist($hotel);
           $entityManager->flush();
   
           $this->addFlash('success', 'L hotel a été ajouté avec succès.');
   
           return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
       }

        return $this->renderForm('hotel/new.html.twig', [
            'hotel' => $hotel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hotel_show', methods: ['GET'])]
    public function show(Hotel $hotel): Response
    {
        return $this->render('hotel/show.html.twig', [
            'hotel' => $hotel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_hotel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hotel $hotel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HotelType::class, $hotel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hotel/edit.html.twig', [
            'hotel' => $hotel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_hotel_delete', methods: ['POST'])]
    public function delete(Request $request, Hotel $hotel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hotel->getId(), $request->request->get('_token'))) {
            $entityManager->remove($hotel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
    }
}
