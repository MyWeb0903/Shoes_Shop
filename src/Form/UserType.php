<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
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
                    'placeholder' => 'Enter the full name',
                    'required oninvalid' => 'this.setCustomValidity("Please enter the full name here!")',
                     'oninput' => 'setCustomValidity("")'
                    ]
            ])
            ->add('Email', EmailType::class, [
                 'attr' => [
                    'placeholder' => 'Enter the email',
                    'required oninvalid' => 'this.setCustomValidity("Please enter the email here!")',
                     'oninput' => 'setCustomValidity("")'
                    ]
            ])
            ->add('Address', TextType::class, [
                 'attr' => [
                    'placeholder' => 'Enter the address',
                    'required oninvalid' => 'this.setCustomValidity("Please enter the address here!")',
                     'oninput' => 'setCustomValidity("")'
                    ]
            ])
            ->add('Phone', TextType::class, [
                 'attr' => [
                    'placeholder' => 'Enter the phone number',
                    'required oninvalid' => 'this.setCustomValidity("Please enter the phone number here!")',
                     'oninput' => 'setCustomValidity("")'
                    ]
            ])
            ->add('Gender', TextType::class, [
                 'attr' => [
                    'placeholder' => 'Enter full name',
                    'required oninvalid' => 'this.setCustomValidity("Please enter the full name here!")',
                     'oninput' => 'setCustomValidity("")'
                    ]
            ])
            ->add('Gender', TextType::class, [
                 'attr' => [
                    'placeholder' => 'Enter full name',
                    'required oninvalid' => 'this.setCustomValidity("Please enter the full name here!")',
                     'oninput' => 'setCustomValidity("")'
                    ]
            ])
            ->add('Birthday', DateTimeType::class, [
                'widget' => 'single_text'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
