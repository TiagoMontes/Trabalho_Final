<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class DirectorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class, [
                'label' => 'Nome',
                'attr' => ['class' => 'mb-3 form-control text-center'], 
            ])
            ->add('last_name', TextType::class, [
                'label' => 'Sobrenome',
                'attr' => ['class' => 'mb-3 form-control text-center'],
            ])
            ->add('age', NumberType::class, [
                'label' => 'Idade',
                'attr' => ['class' => 'mb-3 form-control text-center'],
            ])
            ->add('oscars', NumberType::class, [
                'label' => 'Oscars',
                'attr' => ['class' => 'mb-3 form-control text-center'],
            ])
            ->add('Salvar', SubmitType::class, array('attr' => array('class' => 'btn btn-primary form-control')));
    }   
}
