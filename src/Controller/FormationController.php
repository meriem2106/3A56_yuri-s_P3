<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Knp\Component\Pager\PaginatorInterface;


#[Route('/formation')]
class FormationController extends AbstractController
{
    #[Route('/', name: 'app_formation_index', methods: ['GET'])]
    public function index(FormationRepository $formationRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $searchQuery = $request->query->get('search');
        $queryBuilder = $formationRepository->createQueryBuilder('f');
    
        if ($searchQuery) {
            $queryBuilder->andWhere('LOWER(f.title) LIKE :search')
                         ->setParameter('search', '%' . strtolower($searchQuery) . '%');
        }
    
        $data = $queryBuilder->getQuery()->getResult();
    
        $formations = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6   // Nombre d'éléments par page
        );
    
        return $this->render('BackOffice/formation/index.html.twig', [
            'formations' => $formations,
        ]);
    }
    #[Route('Front/', name: 'app_formation_indexF', methods: ['GET'])]
    public function indexF(FormationRepository $formationRepository): Response
    {
        return $this->render('FrontOffice/formation/indexF.html.twig', [
            'formations' => $formationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_formation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,): Response
    {
        $formation = new Formation();
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($formation);
            $entityManager->flush();

            return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('FrontOffice/formation/new.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formation_show', methods: ['GET'])]
    public function show(Formation $formation): Response
    {
        return $this->render('BackOffice/formation/show.html.twig', [
            'formation' => $formation,
        ]);
    }
    #[Route('front/{id}', name: 'app_formation_showF', methods: ['GET'])]
    public function showF(Formation $formation): Response
    {
        return $this->render('FrontOffice/formation/showF.html.twig', [
            'formation' => $formation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_formation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Formation $formation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('FrontOffice/formation/edit.html.twig', [
            'formation' => $formation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_formation_delete', methods: ['POST'])]
    public function delete(Request $request, Formation $formation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($formation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_formation_index', [], Response::HTTP_SEE_OTHER);
    }
}
