<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ResetPasswordRequestFormType extends AbstractType
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
