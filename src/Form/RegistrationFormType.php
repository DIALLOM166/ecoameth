<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'label' => 'Email<span class="text-white">*</span>',
                'label_html' => true,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Saisir une adresse email'
                ],
                'constraints' => [
                    new Email([
                        'message' => 'Veuiller saisir une adresse email validé'
                    ]),
                    new NotBlank([
                        'message' => 'Veuiller saisir une adresse email' 
                    ])
                ]
            ])
            ->add('lastName', null,[
                    'label' => 'Prénom<span class="text-white">*</span>',
                    'label_html' => true,
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Saisir un prénom'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuiller saisir un prénom' 
                        ])
                    ]
                ])

           
            ->add('firstName', null,[
                'label' => 'Nom<span class="text-white">*</span>',
                'label_html' => true,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Saisir un nom'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuiller saisir un nom' 
                    ])
                ]
            ])
           
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'J\'accepte les conditions générales d\'utilisation du site <span class="text-white">*</span>',
                'label_html' => true,
                'required' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions générales d\'utilisation du site.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => 'Mot de passe<span class="text-white">*</span>',
                'label_html' => true,
                'required' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/',
                        'match' => true,
                        'message' => 'Votre mot de passe doit contenir au moins 12 caractères, 
                        incluant au moins une lettre majuscule, une lettre minuscule, 
                        un chiffre et un symbole : - + * $ @ % _ ?.'
                        
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
