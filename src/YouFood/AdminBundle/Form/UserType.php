<?php

namespace YouFood\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('status')
        ;
    }

    public function getName()
    {
        return 'youfood_adminbundle_usertype';
    }
}
