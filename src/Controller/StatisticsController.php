<?php

namespace App\Controller;

use App\Repository\MaterielRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StatisticsController extends AbstractController
{
    #[Route('/materiel/statistiques', name: 'app_statistics', methods: ['GET'])]
    public function statistics(MaterielRepository $materielRepository): Response
    {
        $statistics = $materielRepository->countByAllStatus();

        return $this->render('material/statistiques.html.twig', [
            'statistiques' => $statistics,
        ]);
    }
}
