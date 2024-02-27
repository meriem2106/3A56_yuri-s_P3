<?php

namespace App\Controller;

use App\Entity\ReservationM;
use App\Form\ReservationMType;
use App\Repository\ReservationMRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservation/m')]
class ReservationMController extends AbstractController
{
    #[Route('/', name: 'app_reservation_m_index', methods: ['GET'])]
    public function index(ReservationMRepository $reservationMRepository): Response
    {
        return $this->render('reservation_m/index.html.twig', [
            'reservation_ms' => $reservationMRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservation_m_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationM = new ReservationM();
        $form = $this->createForm(ReservationMType::class, $reservationM);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationM);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_m_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_m/new.html.twig', [
            'reservation_m' => $reservationM,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_m_show', methods: ['GET'])]
    public function show(ReservationM $reservationM): Response
    {
        return $this->render('reservation_m/show.html.twig', [
            'reservation_m' => $reservationM,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_m_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationM $reservationM, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationMType::class, $reservationM);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_m_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_m/edit.html.twig', [
            'reservation_m' => $reservationM,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_m_delete', methods: ['POST'])]
    public function delete(Request $request, ReservationM $reservationM, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationM->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservationM);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_m_index', [], Response::HTTP_SEE_OTHER);
    }
}
