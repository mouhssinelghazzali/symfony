<?php

namespace App\Form;

use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

use App\Entity\Optionn;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice',IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' =>[
                    'placeholder' => 'Budget maximale'
                ]

            ])
            ->add('minSurface',IntegerType::class,[
                'required' => false,
                'label' => false,
                'attr' =>[
                    'placeholder' => 'Surface minimale'
                ]

            ])
            
            ->add('distance', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'choices' => [
                    '10 km' => 10,
                    '1000 km' => 1000
                ]
            ])
            ->add('lat', HiddenType::class)
            ->add('lng', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
{
    return '';
}
}
