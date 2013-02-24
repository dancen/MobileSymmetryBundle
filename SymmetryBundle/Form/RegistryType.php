<?php

namespace Mobile\SymmetryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('service_name')
            ->add('resource')
            ->add('class_name')
            ->add('method_name')
            ->add('description')
            ->add('active')
            //->add('created_at','date')
            //->add('updated_at','date')
        ;
    }

    public function getName()
    {
        return 'mobile_symmetrybundle_registrytype';
    }
    
     public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mobile\SymmetryBundle\Entity\Registry',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            // a unique key to help generate the secret token
            'intention' => 'registry_form',  
        ));
    }
}
