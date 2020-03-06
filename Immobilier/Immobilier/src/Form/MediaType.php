<?php

namespace App\Form;

use App\Entity\Logement;
use App\Entity\Media;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('logement', EntityType::class, array(
                'class' => Logement::class,
                'choice_label' => 'nomLogement',
                'label' => 'Liste des logements',
                'multiple' => false
            ))
            ->add('nomMedia')
            ->add('imageFile', FileType::class, array(
                'label' => 'Image'
            ))
            ->add('statut')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
        ]);
    }
}
