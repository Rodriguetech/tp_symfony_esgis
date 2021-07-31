<?php

namespace App\Form;

use App\Entity\Ouvrage;
use App\Entity\Pays;
use App\Repository\PaysRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OuvrageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ISBN',TextType::class,[
                "label" => false
            ])

            ->add('nbPage',NumberType::class,[
                "label" => false
            ])
            ->add('titre', TextType::class,[
                "label" => false
            ])

            ->add('codePays', EntityType::class,[
                'label' => false,
                'expanded' => false,
                'multiple' => false,
                'class' => Pays::class,
                'query_builder' => function (PaysRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.codePays', 'ASC');
                },
                'choice_label' => 'codePays',
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Enrégistrer",
                'attr' => [
                    'class' => 'inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ouvrage::class,
        ]);
    }
}
