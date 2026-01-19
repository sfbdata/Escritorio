<?php

namespace App\Controller\Admin;

use App\Entity\Processo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProcessoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Processo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('numero', 'Número do Processo'),
            TextareaField::new('descricao', 'Descrição'),
            TextField::new('status', 'Status'),
            DateField::new('data', 'Data do Processo'),
            DateTimeField::new('proximoPrazo', 'Próximo Prazo'),

            // Relacionamentos
            AssociationField::new('cliente', 'Clientes')
                ->setFormTypeOption('by_reference', false),
            AssociationField::new('responsavel', 'Responsáveis')
                ->setFormTypeOption('by_reference', false),
            AssociationField::new('documentos', 'Documentos')
                ->setFormTypeOption('by_reference', false),
        ];
    }
}
