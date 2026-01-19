<?php

namespace App\Controller\Admin;

use App\Entity\Documento;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DocumentoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Documento::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titulo', 'Título'),
            TextField::new('arquivo', 'Arquivo'),

            // Relacionamentos
            AssociationField::new('processo', 'Processo'),
            AssociationField::new('clientes', 'Clientes')
                ->setFormTypeOption('by_reference', false),
        ];
    }
}
