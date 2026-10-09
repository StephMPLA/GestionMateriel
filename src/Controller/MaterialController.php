<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Form\MaterielType;
use App\Repository\MaterielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MaterialController extends AbstractController
{
    #[Route('/materiel', name: 'app_material', methods: ['GET'])]
    public function index(MaterielRepository $materielRepository): Response
    {
        $materials = $materielRepository->findAllOrderedByNameASC();

        return $this->render('material/index.html.twig', [
            'materials' => $materials,
        ]);
    }

    #[Route('/materiel/ajouter', name: 'app_addMateriel', methods: ['GET', 'POST'])]
    public function addMateriel(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $material = new Materiel();
        $form = $this->createForm(MaterielType::class, $material);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManagerInterface->persist($material);
            $entityManagerInterface->flush();
            $this->addFlash(
                'success',
                'Your changes were saved!'
            );

            return $this->redirectToRoute('app_material');
        }

        return $this->render('material/form.html.twig', [
            'form' => $form,
        ]);
    }
}
