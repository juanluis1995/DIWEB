<?php

namespace App\Form;

use App\Entity\Producto;
use Joomla\CMS\Language\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('precio', MoneyType::class, [
                "label" => "Precio"
            ])
            ->add('tamanio', TextType::class, [
                "label" => "Tamaño:"
            ])
            ->add('fotografia', FileType::class, [
                "label" => "Imagen:",
                'mapped' => false,
                "data_class" => null
            ])
            ->add('descripcion', TextareaType::class, [
                 "label" => "Descripción:"

            ])
            ->add('existencias', IntegerType::class, [
                'invalid_message' => 'Escribe un número entero'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Producto::class,
        ]);
    }
}
