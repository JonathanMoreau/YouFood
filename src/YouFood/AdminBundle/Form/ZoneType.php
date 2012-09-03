<?php

namespace YouFood\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ZoneType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('user', 'entity', 
                array('class'=>'YouFoodAdminBundle:User',
                    'property'=>'name',
                    'empty_value' => ' ',
                    'required' => true,
                    ))
        ;
    }

    public function getName()
    {
        return 'youfood_adminbundle_zonetype';
    }

        public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'YouFood\AdminBundle\Entity\Zone',
        );
    }
}
