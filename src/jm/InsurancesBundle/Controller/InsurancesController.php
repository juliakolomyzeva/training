<?php
/**
 * Created by PhpStorm.
 * User: jumu
 * Date: 10.09.17
 * Time: 00:04
 */

namespace jm\InsurancesBundle\Controller;

use jm\InsurancesBundle\Form\InsuranceType;
use jm\InsurancesBundle\Entity\Insurance;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;

class InsurancesController extends Controller
{
    /**
     * @Route("/Insurances/create_insurance/{categoryName}", name="create_insurance")
     */
    public function createAction(Request $request, $categoryName="")
    {
        // 1) build the form
        $insurance = new Insurance();
        $form = $this->createForm(InsuranceType::class, $insurance);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) save the Insurance!
            $em = $this->getDoctrine()->getManager();
            /* What's really cool is that you'll use these exact two following lines
            whether you're inserting a new Entity or updating an existing one.
            Doctrine figures out the right query to use.*/
            $em->persist($insurance); //tells Doctrine that you want to save this
            $em->flush(); //But the query isn't made until you call flush()

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            //
            return $this->redirectToRoute('show_insurance', array('insName' => $insurance->getName()));
        }

        return $this->render(
            'InsurancesBundle:insurances:createInsurance.html.twig',
            array('form' => $form->createView())
        );
    }
    /**
     * @Route("/show_insurance/{insName}", name="show_insurance")
     */
    public function showAction($insName)
    {
        $em = $this->getDoctrine()->getManager();
        $insurance = $em->getRepository('InsurancesBundle:Insurance')
            ->findOneBy(['name' => $insName]);
        // todo - add the caching back later
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
        return $this->render('InsurancesBundle:insurances:insurance.html.twig', array(
            'insurance' => $insurance
        ));
    }

    /**
     * @Route("/Insurances/showByCategory/{categoryId}", name="show_insurances_list")
     */
    public function showInsurancesList($categoryId, $categoryName ='')
    {
        $insurances = $this->getInsurances($categoryId);
        if(count($insurances) > 0) {
            return $this->render('InsurancesBundle:insurances:insurancesList.html.twig', [
                'insurances' => $insurances,
                'categoryName' => $categoryName
            ]);
        } else {
            return $this->render('InsurancesBundle:insurances:startPage.html.twig');
        }
    }

    public function getInsurances($categoryId = '')
    {
        $em = $this->getDoctrine()->getManager();
        if($categoryId == '') {
            $insurances = $em->getRepository('InsurancesBundle:Insurance')->findAll();
        }else{
            $insurances = $em->getRepository('InsurancesBundle:Insurance')->findBy(['categoryId' => $categoryId]);
        }
        return $insurances;
    }

}
