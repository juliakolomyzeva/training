<?php

namespace jm\InsurancesBundle\Form;

use Doctrine\ORM\EntityManagerInterface;
use jm\InsurancesBundle\Entity\RelCategory;
use jm\InsurancesBundle\Service\CategoryManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RelCategoryType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
     //   $catManager = $options['category_manager'];
     //   $categories = $catManager->getAllCategories();
        $builder
            ->add('name')
            ->add('description')
            ->add('parent_category', EntityType::class, array(
                    "class" => RelCategory::class,
                    'placeholder' => 'Choose a parent category',
                    'required' => false,
//                'choices' => array($categories),
//                'choice_label' => function($category, $key, $index) {
//                    /** @var RelCategory $category */
//                    return strtoupper($category->getName());
//                },
//                'choice_attr' => function($category, $key, $index) {
//                    return array('class' => 'category_'.strtolower($category->getName()));
//                },
                'mapped' => false,
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'jm\InsurancesBundle\Entity\RelCategory'
        ));
        $resolver->setRequired('category_manager');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'jm_insurancesbundle_relcategory';
    }


}
