<?php

namespace App\Form;

use App\Entity\Comment;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Votre commentaire',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Commentaire', 'rows' => 6],
            ])
            // ->add('createdAt')
            // ->add('article')
            // ->add('User');
            ->add('commenter', SubmitType::class, [
                'label' => 'Poster le commentaire', // Personnalisez le texte du bouton ici
                'attr' => ['class' => 'btn btn-success',]
            ]);;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
