<?php

namespace App\Controller\Admin;

use App\Entity\Test2;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class Test2CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Test2::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex()
                ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('name'),

            ImageField::new('imageName')
                ->setUploadDir('public/uploads/images')
                ->setBasePath('public/uploads/images')
                ->setRequired(false),
        ];
    }
}
