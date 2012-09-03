<?php

namespace YouFood\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FoodCategoryType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
        ;
    }

    public function getName()
    {
        return 'youfood_adminbundle_foodcategorytype';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'YouFood\AdminBundle\Entity\FoodCategory',
        );
    }
}
