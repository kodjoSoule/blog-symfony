<?php

namespace App\Form;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\TextEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            // ->add('roles')
            // ->add('password')
            // ->add('isVerified')

            ->add('firstname', TextType::class, [
                'label' => false,
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Le champ "Prenom" ne peut pas être vide.',
                    ]),
                ],

            ])
            ->add(
                'lastname',
                TextType::class,
                [
                    'label' => false,
                ]
            )
            ->add('username', TextType::class, [
                'label' => false,
            ])
            ->add('email', TextType::class, [
                'label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'L\'adresse e-mail ne peut pas être vide.',
                        'groups' => ['registration'],
                    ]),
                ],
            ])
            ->add(
                'telephone',
                TextType::class,
                [
                    'label' => false,
                ]
            )
            ->add('aPropos', TextEditorType::class, [
                'label' => false,
                'attr' => ['class' => 'form-control', 'id' => 'tinymce', 'rows' => 6],



            ])
            ->add('instagram', TextType::class, [
                'label' => false,
            ])
            ->add('job', TextType::class, [
                'label' => false,
            ])
            ->add('country', TextType::class, [
                'label' => false,
            ])
            ->add('linkedin', TextType::class, [
                'label' => false,
            ])

            ->add('facebook', TextType::class, [
                'label' => false,
            ])
            ->add('twitter', TextType::class, [
                'label' => false,
            ])
            ->add('compagny', TextType::class, [
                'label' => false,
            ])
            ->add('address', TextType::class, [
                'label' => false,
            ]);
        // ->add('Enregistrer', SubmitType::class, [
        //     'attr' => ['class' => 'btn btn-success d-block mx-auto',]
        // ]);
        // ->add('image');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => function (FormInterface $form) {
                $data = $form->getData();

                if ($data->getEmail()) {
                    return ['Default', 'registration'];
                }

                return ['Default'];
            },
        ]);
    }
}
