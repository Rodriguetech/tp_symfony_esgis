<?php

namespace App\Form;

use App\Entity\Moment;
use App\Entity\Musee;
use App\Entity\Visiter;
use App\Repository\MomentRepository;
use App\Repository\MuseeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisiterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder


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


            ->add('jour', EntityType::class,[
                'label' => false,
                'expanded' => false,
                'multiple' => false,
                'class' => Moment::class,
                'query_builder' => function (MomentRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.jour', 'ASC');
                },
                'choice_label' => 'jour',
            ])

            ->add('nbvisiteurs',NumberType::class,[
                "label" => false
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
            'data_class' => Visiter::class,
        ]);
    }
}
