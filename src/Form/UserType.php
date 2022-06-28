<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class)
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Not match',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => 'Confirm the password']
            ])
            ->add('Fullname', TextType::class, [
                 'attr' => [
                    'placeholder' => 'Enter your full name',
                    'required oninvalid' => 'this.setCustomValidity("Please enter the full name here!")',
                     'oninput' => 'setCustomValidity("")'
                    ]
            ])
            ->add('Email', EmailType::class, [
                 'attr' => [
                    'placeholder' => 'Enter your email',
                    'required oninvalid' => 'this.setCustomValidity("Please enter email here!")',
                     'oninput' => 'setCustomValidity("")'
                    ]
            ])
            ->add('Address', TextType::class, [
                 'attr' => [
                    'placeholder' => 'Enter your address',
                    'required oninvalid' => 'this.setCustomValidity("Please enter address here!")',
                     'oninput' => 'setCustomValidity("")'
                    ]
            ])
            ->add('Phone', TextType::class, [
                 'attr' => [
                    'placeholder' => 'Enter your phone number',
                    'required oninvalid' => 'this.setCustomValidity("Please enter phone number here!")',
                     'oninput' => 'setCustomValidity("")'
                    ]
            ])
            ->add('Gender', TextType::class, [
                 'attr' => [
                    'placeholder' => 'Enter full name',
                    'required oninvalid' => 'this.setCustomValidity("Please enter role here!")',
                     'oninput' => 'setCustomValidity("")'
                    ]
            ])
            ->add('Gender', TextType::class, [
                 'attr' => [
                    'placeholder' => 'Enter your gender',
                    'required oninvalid' => 'this.setCustomValidity("Please enter gender here!")',
                     'oninput' => 'setCustomValidity("")'
                    ]
            ])
            ->add('Birthday', DateTimeType::class, [
                'widget' => 'single_text'
            ])
            ->add('agreeTerms', CheckboxType::class, ['mapped' => false,
                'attr' => [
                   
                    'oninvalid' => 'this.setCustomValidity("Please check this box if you want to proceed")',
                    'onclick' => 'setCustomValidity("")'
                    ]
            ])
            ->add('Register', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success',
                    'style' => 'margin-left: 150px'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class
            // Configure your form options here
        ]);
    }
}