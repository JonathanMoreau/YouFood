<?php

namespace YouFood\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BoardType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('number', 'text')
            ->add('zone', 'entity', 
                array('class'=>'YouFoodAdminBundle:Zone',
                    'property'=>'name',
                    'empty_value' => ' ',
                    'required' => true,
                    ))
        ;
    }

    public function getName()
    {
        return 'youfood_adminbundle_boardtype';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'YouFood\AdminBundle\Entity\Board',
        );
    }
}
