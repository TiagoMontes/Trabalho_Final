<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category_name', TextType::class, array('attr' => array('class' => 'ml-3')), ['label' => 'Nome da categoria: '])
            ->add('Salvar', SubmitType::class, array('attr' => array('class' => 'btn btn-primary')));
    }
}
