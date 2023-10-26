<?php

namespace App\Form;

use App\Entity\Test2;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class Test2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            // ->add('image', FileType::class, [ // Utilisez FileType pour le champ d'image
            //     'label' => 'Image', // Étiquette personnalisée
            //     'required' => false, // Le champ n'est pas obligatoire
            //     'mapped' => false, // Ne pas mapper directement vers l'entité Test2
            //     'attr' => ['accept' => 'image/*'], // Spécifiez les types de fichiers autorisés
            // ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image',  // Optionnel : étiquette personnalisée
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Test2::class,
        ]);
    }
}
