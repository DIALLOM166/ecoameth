<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;
use Symfony\Component\Validator\Constraints\PasswordStrength;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
        $resolver->setDefaults([]);
    }
}
