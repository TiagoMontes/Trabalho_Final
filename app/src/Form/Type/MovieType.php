<?php 

namespace App\Form\Type;

use App\Entity\Movie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nome',
                'row_attr' => ['class' => 'form-group'],
                'attr' => ['class' => 'form-control'], 
            ]);
            // ->add('genre_id', EntityType::class, [
            //     'class' => Movie::class,
            //     'choice_label' => 'genre'
            // ]);
    }
}
