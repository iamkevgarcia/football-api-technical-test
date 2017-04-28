<?php

namespace FootballManagerBundle\Form\Type;

use FootballManagerBundle\Entity\Player;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlayerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'name',
            TextType::class,
            array('required' => true)
        )->add(
            'surname',
            TextType::class,
            array('required' => true)
        )->add( 'team', EntityType::class, array(
            'class'  => 'FootballManagerBundle:Team',
            'required' => true,
            'em' => 'default'
        ) );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Player::class
        ));
    }
}