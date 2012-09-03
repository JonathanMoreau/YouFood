<?php

namespace YouFood\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('started')
            ->add('ended')
            ->add('foods', 'collection', array('type' => new FoodType, 'prototype' => true, 'allow_add' => true))
        ;
    }

    public function getName()
    {
        return 'youfood_adminbundle_menutype';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'YouFood\AdminBundle\Entity\Menu',
        );
    }
}
