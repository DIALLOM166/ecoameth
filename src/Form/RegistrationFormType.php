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
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

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
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'attr' => [
                        'autocomplete' => 'new-password',
                    ],
                ],
                'first_options' => [
                    'label' => 'Mot de passe<span class="text-white">*</span>',
                    'label_html' => true,
                    'attr' => [
                        'placeholder' => 'saisir un mot de passe',
                    ],
                ],
                'second_options' => [
                   'label' => 'Confirmation du mot de passe<span class="text-white">*</span>',
                    'label_html' => true,
                    'attr' => [
                        'placeholder' => 'Confirmer le mot de passe',
                    ],
                ],
                 'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un mot de passe',
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/',
                        'match' => true,
                        'message' => 'Votre mot de passe doit contenir au moins 12 caractères, 
                        incluant au moins une lettre majuscule, une lettre minuscule, 
                        un chiffre et un symbole : - + * $ @ % _ ?.'
                        
                    ]),
                ],
                'invalid_message' => 'Les mots de passe doivent étre identique.',
                'mapped' => false,
                'required' =>false,
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
