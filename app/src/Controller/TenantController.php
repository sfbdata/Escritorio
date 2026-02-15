<?php

namespace App\Controller;

use App\Entity\Tenant;
use App\Entity\User;
use App\Form\TenantType;
use App\Repository\TenantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/tenant')]
final class TenantController extends AbstractController
{
    #[Route(name: 'app_tenant_index', methods: ['GET'])]
    public function index(TenantRepository $tenantRepository): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('Você precisa estar logado.');
        }

        if (in_array('ROLE_SUPER_ADMIN', $user->getRoles(), true)) {
            // SUPER_ADMIN vê todos os Tenants
            $tenants = $tenantRepository->findAll();
        } elseif (in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            // ADMIN vê apenas o Tenant ao qual pertence
            $tenants = [$user->getTenant()];
        } else {
            throw $this->createAccessDeniedException('Você não tem permissão para acessar Tenants.');
        }

        return $this->render('tenant/index.html.twig', [
            'tenants' => $tenants,
        ]);
    }

    #[Route('/new', name: 'app_tenant_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $tenant = new Tenant();
        $form = $this->createForm(TenantType::class, $tenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tenant);
            $entityManager->flush();

            // Criar usuário administrador vinculado ao Tenant
            $adminEmail = $form->get('adminEmail')->getData();
            $adminPassword = $form->get('adminPassword')->getData();

            $adminUser = new User();
            $adminUser->setEmail($adminEmail);
            $adminUser->setPassword($passwordHasher->hashPassword($adminUser, $adminPassword));
            $adminUser->setRoles(['ROLE_ADMIN']);
            $adminUser->setTenant($tenant);
            $adminUser->setIsActive(true);
            $adminUser->setFullName('Administrador do Tenant');

            $entityManager->persist($adminUser);
            $entityManager->flush();

            $this->addFlash('success', 'Tenant criado com sucesso e administrador configurado.');

            return $this->redirectToRoute('app_tenant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tenant/new.html.twig', [
            'tenant' => $tenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tenant_show', methods: ['GET'])]
    public function show(Tenant $tenant): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException();
        }

        if (in_array('ROLE_SUPER_ADMIN', $user->getRoles(), true)) {
            return $this->render('tenant/show.html.twig', ['tenant' => $tenant]);
        }

        if (in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            if ($user->getTenant()->getId() !== $tenant->getId()) {
                throw $this->createAccessDeniedException('Você não tem permissão para acessar este Tenant.');
            }
            return $this->render('tenant/show.html.twig', ['tenant' => $tenant]);
        }

        throw $this->createAccessDeniedException('Você não tem permissão para ver este Tenant.');
    }

    #[Route('/{id}/edit', name: 'app_tenant_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tenant $tenant, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException();
        }

        if (in_array('ROLE_SUPER_ADMIN', $user->getRoles(), true) ||
            (in_array('ROLE_ADMIN', $user->getRoles(), true) && $user->getTenant() === $tenant)) {
            $form = $this->createForm(TenantType::class, $tenant);
        } else {
            throw $this->createAccessDeniedException('Você não tem permissão para editar este Tenant.');
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_tenant_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tenant/edit.html.twig', [
            'tenant' => $tenant,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tenant_delete', methods: ['POST'])]
    public function delete(Request $request, Tenant $tenant, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException();
        }

        if (!in_array('ROLE_SUPER_ADMIN', $user->getRoles(), true)) {
            throw $this->createAccessDeniedException('Somente SUPER_ADMIN pode excluir Tenants.');
        }

        if ($this->isCsrfTokenValid('delete'.$tenant->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tenant);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tenant_index', [], Response::HTTP_SEE_OTHER);
    }
}
