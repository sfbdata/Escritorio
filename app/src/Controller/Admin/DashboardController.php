<?php

namespace App\Controller\Admin;

use App\Entity\Cliente;
use App\Entity\Processo;
use App\Entity\Funcionario;
use App\Entity\Documento;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response 
    { 
        // Redireciona para o CRUD de Cliente (pode ser qualquer entidade) 
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class); 
        return $this->redirect($adminUrlGenerator->setController(ClienteCrudController::class)->generateUrl()); 
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Clientes', 'fa fa-user', Cliente::class);
        yield MenuItem::linkToCrud('Processos', 'fa fa-gavel', Processo::class);
        yield MenuItem::linkToCrud('Funcionários', 'fa fa-users', Funcionario::class);
        yield MenuItem::linkToCrud('Documentos', 'fa fa-file', Documento::class);
    }
}
