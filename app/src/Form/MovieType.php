<?php

namespace App\Form\Type;

use App\Entity\Category;
use App\Entity\Director;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nome do Filme', 
                'attr' => ['class' => 'form-control mb-3']
            ])
            ->add('description', TextType::class, [
                'label' => 'Descrição', 
                'attr' => ['class' => 'form-control mb-3']
            ])
            ->add('duration', NumberType::class, [
                'label' => 'Duração',
                'attr' => [
                    'class' => 'form-control mb-3', 
                    'placeholder' => 'min'
                ]
            ])
            ->add('release_date', TextType::class, [
                'label' => 'Data de Lançamento', 
                'attr' => array('class' => 'form-control mb-3'),
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'categoryName',
                'label' => 'Gênero',
                'attr' => array('class' => 'form-control mb-3')
            ])
            ->add('director', EntityType::class, [
                'class' => Director::class,
                'choice_label' => 'first_name',
                'label' => 'Diretor',
                'attr' => array('class' => 'form-control mb-3')
            ])
            ->add('Salvar', SubmitType::class, array('attr' => array('class' => 'btn btn-primary mt-4 w-100')));
    }
}
