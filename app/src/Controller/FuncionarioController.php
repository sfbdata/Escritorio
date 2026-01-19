<?php

namespace App\Controller;

use App\Entity\Funcionario;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FuncionarioController extends AbstractController
{
    #[Route('/funcionario', name: 'app_funcionario')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $funcionarios = $entityManager->getRepository(Funcionario::class)->findAll();

        return $this->render('funcionario/index.html.twig', [
            'funcionarios' => $funcionarios,
        ]);
    }
}
