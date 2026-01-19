<?php

namespace App\Controller\Admin;

use App\Entity\Cliente;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClienteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cliente::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nome', 'Nome'),
            EmailField::new('email', 'Email'),
            TextField::new('telefone', 'Telefone'),

            // Relacionamentos
            AssociationField::new('processos', 'Processos')
                ->setFormTypeOption('by_reference', false),
            AssociationField::new('documentos', 'Documentos')
                ->setFormTypeOption('by_reference', false),
        ];
    }
}
