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
            ->add('first_name', TextType::class, array('attr' => array('class' => 'mt-3')), ['label' => 'Nome: '])
            ->add('last_name', TextType::class, array('attr' => array('class' => 'mt-3')), ['label' => 'Sobrenome: '])
            ->add('age', NumberType::class, array('attr' => array('class' => 'mt-3')), ['label' => 'Idade: '])
            ->add('oscars', NumberType::class, array('attr' => array('class' => 'mt-3')), ['label' => 'Oscars: '])
            ->add('Salvar', SubmitType::class, array('attr' => array('class' => 'btn btn-primary mt-3')));
    }   
}
