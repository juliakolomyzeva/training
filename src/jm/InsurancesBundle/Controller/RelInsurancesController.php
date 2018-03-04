<?php
/**
 * Created by PhpStorm.
 * User: jumu
 * Date: 10.09.17
 * Time: 00:04
 */

namespace jm\InsurancesBundle\Controller;

use jm\InsurancesBundle\Form\RelInsuranceType;
use jm\InsurancesBundle\Entity\RelInsurance;
use jm\InsurancesBundle\Service\CategoryManager;
use jm\InsurancesBundle\Service\InsuranceManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;

class RelInsurancesController extends Controller
{
    /**
     * @Route("/RelInsurances/create_insurance/{categoryName}", name="create_relinsurance")
     */
    public function createAction(Request $request, InsuranceManager $insuranceManager, CategoryManager $categoryManager, $categoryName="")
    {
        if ($categoryName != "") {
            $category = $categoryManager->getCategoryByName($categoryName);
        } else {
            $category = false;
        }
        // 1) build the form
        $insurance = new RelInsurance();
        $form = $this->createForm(RelInsuranceType::class, $insurance, array(
            'category' => $category,
        ));

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) save the Insurance!
            $parentCategory = $form->get('parent_category')->getData();
            $insurance->setCategory($parentCategory);
            $insuranceManager->saveInsurance($insurance);
            return $this->redirectToRoute('show_relinsurance', array('insuranceName' => $insurance));
        }

        return $this->render(
            'InsurancesBundle:insurances:createInsurance.html.twig',
            array('form' => $form->createView())
        );
    }
    /**
     * @Route("/RelInsurances/edit_insurance/{insuranceId}", name="edit_relinsurance")
     */
    public function editAction(Request $request, InsuranceManager $insuranceManager, $insuranceId)
    {

        // 1) build the form
        $insurance = $insuranceManager->getInsById($insuranceId);
        $category = $insurance->getCategory();
        $form = $this->createForm(RelInsuranceType::class, $insurance, array(
            'category' => $category,
        ));

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) save the Insurance!
            $parentCategory = $form->get('parent_category')->getData();
            $insurance->setCategory($parentCategory);
            $insuranceManager->saveInsurance($insurance);
            return $this->redirectToRoute('show_relinsurance', array('insuranceName' => $insurance));
        }

        return $this->render(
            'InsurancesBundle:insurances:createInsurance.html.twig',
            array('form' => $form->createView())
        );
    }
    /**
     * @Route("/RelInsurances/show_insurance/{insuranceName}", name="show_relinsurance")
     */
    public function showAction($insuranceName, InsuranceManager $insuranceManager)
    {

        /* todo - add the caching back later */
        /*
        $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
        $key = md5($funFact);
        if ($cache->contains($key)) {
            $funFact = $cache->fetch($key);
        } else {
            sleep(1); // fake how slow this could be
            $funFact = $this->get('markdown.parser')
                ->transform($funFact);
            $cache->save($key, $funFact);
        }
        */
        $insurance = $insuranceManager->getInsByName($insuranceName);
        return $this->render('InsurancesBundle:insurances:insurance.html.twig', array(
            'insurance' => $insurance
        ));
    }

    /**
     * @Route("/RelInsurances/showByCategory/{categoryId}", name="show_relinsurances_list")
     */
    public function showInsurancesListAction($categoryId, CategoryManager $categoryManager)
    {
        $category = $categoryManager->getCategoryById($categoryId);
        $categoryManager->setAllToUnselected();
        $category->setSelected(true);
        $insurances = $category->getInsurances();
        if(count($insurances) > 0) {
            return $this->render('InsurancesBundle:insurances:insurancesList.html.twig', [
                'insurances' => $insurances,
                'categoryName' => $category->getName()
            ]);
        } else {
            return $this->render('InsurancesBundle:insurances:startPage.html.twig');
        }
    }



}
