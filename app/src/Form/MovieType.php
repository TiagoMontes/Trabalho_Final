<?php

namespace App\Form\Type;

use App\Entity\Category;
use App\Entity\Director;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
                'attr' => array('class' => 'form-control mb-3')
            ])
            ->add('description', TextType::class, [
                'label' => 'Descrição', 
                'attr' => array('class' => 'form-control mb-3')
            ])
            ->add('duration', NumberType::class, [
                'label' => 'Duração', 
                'attr' => array('class' => 'form-control mb-3')
            ])
            ->add('release_date', DateType::class, [
                'label' => 'Data de lançamento', 
                'attr' => array('class' => 'form-control mb-3')
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
            ->add('Salvar', SubmitType::class, array('attr' => array('class' => 'btn btn-primary mt-3 w-100')));
    }
}
