<?php
namespace App\Form\Type;

use App\Entity\Product;
use App\Entity\Supplier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class
        ]);
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('Name', TextType::class)
        ->add('Quantity', TextType::class)
        ->add('Price', TextType::class, [
            'attr' => ['onkeydown'=>"javascript: return ['Backspace','Delete','ArrowLeft','ArrowRight'].includes(event.code) ? true : !isNaN(Number(event.key)) && event.code!=='Space'"
        ]
        ])
        ->add('Detail', TextType::class)
        ->add('Image', FileType::class, [
            'label' => 'Image',
            'data_class' => null
        ])
        ->add('Supplier_ID', EntityType::class, [
            'class' => Supplier::class,
            'choice_label' => 'name',
            'label' => 'Supplier'
        ])
        ->add('add', SubmitType::class, [
            'label' => 'add'
        ]);

    }
}
?>