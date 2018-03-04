<?php

namespace jm\InsurancesBundle\Controller;

use jm\InsurancesBundle\Contact\ContactMailer;
use jm\InsurancesBundle\Entity\RelCategory;
use jm\InsurancesBundle\Entity\RelCategoryRepository;
use jm\InsurancesBundle\Form\RelCategoryType;
use jm\InsurancesBundle\Service\CategoryManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class RelCategoryController extends Controller
{
   // private $categoryManager;


/*    public function __construct(CategoryManager $categoryManager)
    {
        $this->categoryManager = $categoryManager;
    }*/
    /**
     * @Route("/RelInsurances", name="ins_start")
     */
    public function startAction()
    {
        return $this->render('InsurancesBundle:insurances:startPage.html.twig');
    }
    /**
     * @Route("/RelInsurances/create_category", name="create_category")
     */
    public function createAction(Request $request, CategoryManager $categoryManager)
    {
        // 1) build the form
        $category = new RelCategory();

        $form = $this->createForm(RelCategoryType::class, $category, array(
            'category_manager' => $categoryManager,
        ));
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $parentCategory = $form->get('parent_category')->getData();
            $category->setParent($parentCategory);
            $categoryManager->saveCategory($category);
            // ... do any other work - like sending them an email, etc
            //send Email
           // $this->get(ContactMailer::class)->send($form->getData());

            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('ins_start');
        }

        return $this->render(
            'InsurancesBundle:insurances:createCategory.html.twig',
            array('form' => $form->createView()));
    }



  public function showCategoryMenuAction()
  {
      $categories = $this->get("autowired.jm\InsurancesBundle\Service\CategoryManager")->getAllCategories();
      return $this->render('InsurancesBundle:insurances:leftMenu.html.twig', [
          'categories' => $categories
      ]);
  }

}
