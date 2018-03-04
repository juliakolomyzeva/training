<?php

namespace jm\InsurancesBundle\Form;

use jm\InsurancesBundle\Entity\RelCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RelInsuranceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['category']) {
            $category = $options['category'];
            $placeholder = false;
        } else {
            $category = "";
            $placeholder = 'Choose a parent category';
        }



        $builder
            ->add('name')
            ->add('provider')
            ->add('description')
            ->add('street')
            ->add('location')
            ->add('zip')
            ->add('email')
            ->add('tel')
            ->add('opening_time')
            ->add('notice')
            ->add('parent_category', EntityType::class, array(
                "class"             => RelCategory::class,
                //'placeholder'       => false,
                'placeholder'       => $placeholder,
                'mapped'            => false,
                'required'          => true,
                'preferred_choices' => array($category)
            ));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'jm\InsurancesBundle\Entity\RelInsurance'
        ));
        $resolver->setRequired('category');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jm_insurancesbundle_relinsurance';
    }


}
