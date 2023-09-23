<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\RoleField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return 
        $crud
        
        ->setPaginatorPageSize(5)
        ->setEntityLabelInSingular('Utilisateur')
        ->setEntityLabelInPlural('Utilisateurs')
        ->setSearchFields(['username', 'firstname', 'lastname', 'email']);
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')
            ->hideOnForm()
            ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('Email', 'Email')
            ->setFormTypeOption('disabled', 'disabled'),
            TextField::new('username', 'Nom Utilisateur'),
            TextField::new('firstname', 'Prenom'),
            TextField::new('lastname', 'Nom'),
            ChoiceField::new('roles', 'Role(s)')
            ->setChoices(['User' => 'ROLE_USER', 'Admin' => 'ROLE_ADMIN'])
            ->allowMultipleChoices(),
        ];
    }
    
}
