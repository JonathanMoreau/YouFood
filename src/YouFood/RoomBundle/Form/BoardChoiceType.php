<?php

namespace YouFood\RoomBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BoardChoiceType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('number', 'text')
        ;
    }

    public function getName()
    {
        return 'youfood_roombundle_boardchoicetype';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'YouFood\AdminBundle\Entity\Board',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        );
    }
}
