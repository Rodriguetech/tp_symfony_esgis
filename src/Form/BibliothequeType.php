<?php

namespace App\Form;

use App\Entity\Bibliotheque;
use App\Entity\Musee;
use App\Entity\Ouvrage;
use App\Repository\MuseeRepository;
use App\Repository\OuvrageRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BibliothequeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateAchat', DateType::class, [
                "label" => false
            ])
            ->add('nomMus', EntityType::class,[
                'label' => false,
                'expanded' => false,
                'multiple' => false,
                'class' => Musee::class,
                'query_builder' => function (MuseeRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.nomMus', 'ASC');
                },
                'choice_label' => 'nomMus',
            ])

            ->add('ISBN', EntityType::class,[
                'label' => false,
                'expanded' => false,
                'multiple' => false,
                'class' => Ouvrage::class,
                'query_builder' => function (OuvrageRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.ISBN', 'ASC');
                },
                'choice_label' => 'ISBN',
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
            'data_class' => Bibliotheque::class,
        ]);
    }
}
