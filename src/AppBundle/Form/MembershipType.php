<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MembershipType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type','choice', array(
                'choices'  => array(1 => 'Normal', '2' => 'Golden','3' =>'Platinium'),
                'required' => true))
            ->add('cardNumber')
            ->add('startDate','datetime', array(
                'input'  => 'datetime',
                'widget' => 'single_text',
            ))
            ->add('endDate','datetime', array(
                'input'  => 'datetime',
                'widget' => 'single_text',
            ))
            ->add('client')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Membership'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_membership';
    }
}
