<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use DateTimeImmutable;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm()
                ->hideOnIndex()
                ->setFormTypeOption('disabled', 'disabled'),
            TextEditorField::new('title'),
            DateField::new('createdAt')
                ->setFormat('dd/MM/yyyy HH:mm')
                ->setLabel('Date de création')
                ->setFormTypeOption('disabled', 'disabled'),
            TextEditorField::new('content')
                ->setNumOfRows(30)
                ->setRequired(true),

            ImageField::new('image')
                ->setUploadDir('public/uploads/images')
                ->setBasePath('public/uploads/images')
                ->setRequired(false),

            // TextEditorField::new('imageUrl')
            // ->setLabel('URL de l\'image')
            // ->setRequired(false), // Facultatif, dépend de vos besoins

            // ImageField::new('imageFile')
            // ->setBasePath('/path/to/images') // Remplacez "/path/to/images" par le chemin vers le répertoire où vous souhaitez stocker les images
            // ->setUploadDir('/path/to/upload') // Remplacez "/path/to/upload" par le chemin vers le répertoire où vous souhaitez stocker les images uploadées
            // ->setUploadedFileNamePattern('[randomhash].[extension]') // Définit le format du nom de fichier pour les images uploadées
            // ->setLabel('Upload d\'image')
            // ->setRequired(false) // Facultatif, dépend de vos besoins

        ];
    }
}
