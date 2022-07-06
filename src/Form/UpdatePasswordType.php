<?php
namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdatePasswordType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Not match',
            'options' => ['attr' => ['class' => 'password-field']],
            'required' => true,
            'first_options' => ['label' => 'Password', 'attr' => [
                'placeholder' => 'Enter new password',
                'required oninvalid' => 'this.setCustomValidity("Please enter the password here!")',
                 'oninput' => 'setCustomValidity("")'
                ]],
            'second_options' => ['label' => 'Confirm the password', 'attr' => [
                'placeholder' => 'Confirm new password',
                'required oninvalid' => 'this.setCustomValidity("Please confirm the password here!")',
                 'oninput' => 'setCustomValidity("")'
                ]]
            ])
        ->add('Ok', SubmitType::class, [
             'attr' => [
                'class' => 'btn btn-success',
                'style' => 'margin-left: 98px'
            ]
        ]);
    }
}
?>