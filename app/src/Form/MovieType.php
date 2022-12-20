<?php

namespace App\Form\Type;

use App\Entity\Category;
use Doctrine\DBAL\Types\FloatType;
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
            ->add('title', TextType::class, array('attr' => array('class' => 'form-control mb-3')), ['label' => 'Nome do Filme: '])
            ->add('description', TextType::class, array('attr' => array('class' => 'form-control mb-3')), ['label' => 'Descrição: '])
            ->add('duration', NumberType::class, array('attr' => array('class' => 'form-control mb-3')), ['label' => 'Duração: '])
            ->add('release_date', DateType::class, array('attr' => array('class' => 'form-control mb-3')) ,['label' => 'Data de lançamento: '])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'categoryName',
                'label' => 'Gênero'
            ])
            ->add('Salvar', SubmitType::class, array('attr' => array('class' => 'btn btn-primary mt-3 w-100')));
    }
}
