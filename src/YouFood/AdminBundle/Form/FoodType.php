<?php

namespace YouFood\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

class FoodType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('category', 'entity', 
                array('class'=>'YouFoodAdminBundle:FoodCategory',
                    'property'=>'name',
                    'empty_value' => ' ',
                    'required' => true,
                    'query_builder' => function(EntityRepository $er) {return $er->createQueryBuilder('u')->orderBy('u.id', 'ASC');},))
        ;
    }

    public function getName()
    {
        return 'youfood_adminbundle_foodtype';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'YouFood\AdminBundle\Entity\Food',
        );
    }
}
