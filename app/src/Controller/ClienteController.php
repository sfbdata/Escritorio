<?php

namespace App\Controller;

use App\Entity\Cliente;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClienteController extends AbstractController
{
    #[Route('/cliente', name: 'app_cliente')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Buscar todos os clientes no banco
        $clientes = $entityManager->getRepository(Cliente::class)->findAll();

        // Renderizar a view Twig com os dados
        return $this->render('cliente/index.html.twig', [
            'clientes' => $clientes,
        ]);
    }
}
