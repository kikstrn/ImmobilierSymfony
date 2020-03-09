<?php

namespace App\Form;

use App\Entity\Chauffage;
use App\Entity\EauChaude;
use App\Entity\Localisation;
use App\Entity\Logement;
use App\Entity\Media;
use App\Entity\TypeLogement;
use App\Entity\Vente;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LogementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomLogement', TextType::class, array(
                'label' => 'Nom du Logement'
            ))
            ->add('nombrePiece', TextType::class, array(
                'label' => 'Nombre de pièces'
            ))
            ->add('prix', TextType::class, array(
                'label' => 'Prix'
            ))
            ->add('surfaceTotale', TextType::class, array(
                'label' => 'Surface Totale'
            ))
            ->add('description', TextType::class, array(
                'label' => 'Description'
            ))
            ->add('depot', TextType::class, array(
                'label' => 'Dépôt'
            ))
            ->add('proximite', TextType::class, array(
                'label' => 'Proximité'
            ))
            ->add('typeLogement', EntityType::class, array(
                'class' => TypeLogement::class,
                'required' => false,
                'label' => 'Type de Logement',
                'choice_label' => 'nomTypeLogement',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('type')
                        ->orderBy('type.nomTypeLogement', 'ASC');
                },
            ))
            ->add('localisation', EntityType::class, array(
                'class' => Localisation::class,
                'required' => false,
                'label' => 'Localisation',
                'choice_label' => 'nomLocalisation',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('loc')
                        ->orderBy('loc.nomLocalisation', 'ASC');
                },
            ))
            ->add('chauffage', EntityType::class, array(
                'class' => Chauffage::class,
                'required' => false,
                'label' => 'Type de chauffage',
                'choice_label' => 'nomChauffage',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('ch')
                        ->orderBy('ch.nomChauffage', 'ASC');
                },
            ))
            ->add('eauChaude', EntityType::class, array(
                'class' => EauChaude::class,
                'required' => false,
                'label' => 'Type d\'eau',
                'choice_label' => 'nomEauChaude',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('eau')
                        ->orderBy('eau.nomEauChaude', 'ASC');
                },
            ))
            ->add('vente', EntityType::class, array(
                'class' => Vente::class,
                'required' => false,
                'label' => 'Vente',
                'choice_label' => 'vente',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('vente')
                        ->orderBy('vente.vente', 'ASC');
                },
            ))
//            ->add('media', EntityType::class, array(
//                'class' => Media::class,
////                'required' => false,
//                'label' => 'Photos',
//                'choice_label' => 'nomMedia',
//'multiple' => true
////                'query_builder' => function (EntityRepository $er) {
////                    return $er->createQueryBuilder('vente')
////                        ->orderBy('vente.vente', 'ASC');
////                },
//            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Logement::class,
        ]);
    }
}
