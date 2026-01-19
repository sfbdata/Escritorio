<?php

namespace App\Controller;

use App\Entity\Processo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProcessoController extends AbstractController
{
    #[Route('/processo', name: 'app_processo')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $processos = $entityManager->getRepository(Processo::class)->findAll();

        return $this->render('processo/index.html.twig', [
            'processos' => $processos,
        ]);
    }
}
