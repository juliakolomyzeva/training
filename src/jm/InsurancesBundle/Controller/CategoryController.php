<?php

namespace jm\InsurancesBundle\Controller;

use jm\InsurancesBundle\Entity\Category;
use jm\InsurancesBundle\Contact\ContactMailer;
use jm\InsurancesBundle\Controller\InsurancesController;
use jm\InsurancesBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends Controller
{
    /**
     * @Route("/Insurances", name="ins_start")
     */
    public function startAction()
    {
        return $this->render('InsurancesBundle:insurances:startPage.html.twig');
    }
    /**
     * @Route("/Insurances/create_category", name="create_category")
     */
    public function createAction(Request $request)
    {
        // 1) build the form
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) save the Category!

            /* What's really cool is that you'll use these exact two following lines
            whether you're inserting a new Entity or updating an existing one.
            Doctrine figures out the right query to use.*/
            $em->persist($category); //tells Doctrine that you want to save this
            $em->flush(); //But the query isn't made until you call flush()

            // ... do any other work - like sending them an email, etc
            //send Email
           // $this->get(ContactMailer::class)->send($form->getData());

            // maybe set a "flash" success message for the user
            //dump($category);die;
            return $this->redirectToRoute('ins_start');
        }

        return $this->render(
            'InsurancesBundle:insurances:createCategory.html.twig',
            array('form' => $form->createView()));
    }

    /**
     * @Route("/Insurances/Category/{categoryName}", name="show_children")
     */
  /*  public function showChildren($categoryName)
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('InsurancesBundle:Category')->findBy(['parentId' => null]);
        $category = $em->getRepository('InsurancesBundle:Category')->findOneBy(['name' => $categoryName]);
        if ($category) {
            $subCategories = $em->getRepository('InsurancesBundle:Category')->findBy(['parentId' => $category->getId()]);
            if (count($subCategories) > 0) {
                return $this->render('InsurancesBundle:insurances:categoriesList.html.twig', [
                    'categories' => $categories,
                    'subCategories' => $subCategories,
                    'mainCategoryName' => $category->getName()
                ]);
            }
        }
        return $this->render('InsurancesBundle:insurances:startPage.html.twig');
    }*/

    /**
     * @Route("/Insurances/removeCategory/{categoryName}", name="remove_category")
     */
    public function removeCategory($categoryName)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('InsurancesBundle:Category')->findOneBy(['name' => $categoryName]);
        if ($category) {
            $em->remove($category);
            $em->flush();
        }
        return $this->render('InsurancesBundle:insurances:startPage.html.twig');
    }


    public function getCategories()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('InsurancesBundle:Category')->findBy(['parentId' => null]);
        return $categories;
    }

    public function getCategoryNameById($categoryId)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('InsurancesBundle:Category')->findOneBy(['id' => $categoryId]);
        return $category->getName();
    }

  public function showCategoryMenuAction()
    {
          $em = $this->getDoctrine()->getManager();
          $categories = $em->getRepository('InsurancesBundle:Category')->findAll();
          $sortedCategories = array();
          $categoriesIds = array();
          foreach ($categories as $category) {
                if($category->getParentId()){
                     $mainCategory = $em->getRepository('InsurancesBundle:Category')->findOneBy(['id' => $category->getParentId()]);
                     $sortedCategories[$mainCategory->getName()][] = $category->getName();
                    $categoriesIds[$category->getName()] = $category->getId();
                 }else{
                     if (!array_key_exists($category->getName(), $sortedCategories)) {
                         $sortedCategories[$category->getName()] = array();
                         $categoriesIds[$category->getName()] = $category->getId();
                     }

                 }

             }
            // dump($sortedCategories); die();
       return $this->render('InsurancesBundle:insurances:leftMenu.html.twig', [
            'categories' => $sortedCategories,
           'categoriesIds' => $categoriesIds
        ]);
      }

}
