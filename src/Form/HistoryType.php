<?php

namespace App\Form;

use App\Entity\History;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Auto;

class HistoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('took')
            ->add('gave')
            ->add('auto', EntityType::class,
                ['class' => Auto::class, 'choice_label' => 'number', 'label' => 'Auto number'])
            ->add('departmentFrom')
            ->add('user')
            ->add('departmentTo');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => History::class,
        ]);
    }
}
