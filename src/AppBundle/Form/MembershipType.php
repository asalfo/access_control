<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\DateTime;

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
                'choices'  => array(1 => 'Normal', '2' => 'VIP'),
                'required' => true))
            ->add('cardNumber')
            ->add('startDate','datetime', array(
                'input'  => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd HH:mm:ss'
            ))
            ->add('endDate','datetime', array(
                'input'  => 'datetime',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd HH:mm:ss',
                'required' => false
            ))
            ->add('client',null,array('read_only'=> true))
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
        return 'membership_form';
    }
}
