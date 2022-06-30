<?php
namespace App\Form\Type;

use App\Entity\Order;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('OrderDate', DateTimeType::class)
        ->add('DeliveryDate', DateTimeType::class)
        ->add('Payment', TextType::class)
        ->add('Address', EntityType::class, [
            'class' => User::class
        ])
        ->add('Status', TextType::class)
        ->add('Phone', EntityType::class, [
            'class' => User::class
        ])
        ->add('User', EntityType::class, [
            'class' => User::class
        ])
        ->add('add', SubmitType::class, [
            'label' => 'add'
        ]);
    }

}
?>