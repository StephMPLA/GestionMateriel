<?php

namespace App\Controller;

use App\Repository\MaterielRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
