<?php

namespace jm\InsurancesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InsuranceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categoryId')
            ->add('name')
            ->add('provider')
            ->add('description')
            ->add('street')
            ->add('location')
            ->add('zip')
            ->add('email')
            ->add('tel')
            ->add('opening_time')
            ->add('notice');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'jm\InsurancesBundle\Entity\Insurance'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jm_insurancesbundle_insurance';
    }


}
