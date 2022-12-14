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
            ->add('category_name', TextType::class, [
                'label' => 'Nome da categoria',
                'attr' => array('class' => 'mb-3 form-control')  
                ])
            ->add('Salvar', SubmitType::class, array('attr' => array('class' => 'btn btn-primary mt-4 w-100')));
    }
}
