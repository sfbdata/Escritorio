<?php

namespace App\Controller;

use App\Entity\Documento;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocumentoController extends AbstractController
{
    #[Route('/documento', name: 'app_documento')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $documentos = $entityManager->getRepository(Documento::class)->findAll();

        return $this->render('documento/index.html.twig', [
            'documentos' => $documentos,
        ]);
    }
}
