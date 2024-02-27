<?php

namespace App\Controller;

use App\Entity\ReservationH;
use App\Form\ReservationHType;
use App\Repository\ReservationHRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservation/h')]
class ReservationHController extends AbstractController
{
    #[Route('/', name: 'app_reservation_h_index', methods: ['GET'])]
    public function index(ReservationHRepository $reservationHRepository): Response
    {
        return $this->render('reservation_h/index.html.twig', [
            'reservation_hs' => $reservationHRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservation_h_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationH = new ReservationH();
        $form = $this->createForm(ReservationHType::class, $reservationH);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationH);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_h_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_h/new.html.twig', [
            'reservation_h' => $reservationH,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_h_show', methods: ['GET'])]
    public function show(ReservationH $reservationH): Response
    {
        return $this->render('reservation_h/show.html.twig', [
            'reservation_h' => $reservationH,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_h_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationH $reservationH, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationHType::class, $reservationH);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_h_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_h/edit.html.twig', [
            'reservation_h' => $reservationH,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_h_delete', methods: ['POST'])]
    public function delete(Request $request, ReservationH $reservationH, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationH->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservationH);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_h_index', [], Response::HTTP_SEE_OTHER);
    }
}
