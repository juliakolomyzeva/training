<?php
/**
 * Created by PhpStorm.
 * User: jumu
 * Date: 11.01.18
 * Time: 18:46
 */

namespace jm\InsurancesBundle\Management;

use jm\InsurancesBundle\Entity\Category;
use jm\InsurancesBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityManagerInterface;

class CategoriesManager
{
    /**
     * The Entity Manager.
     */
    private $em;

    /**
     * Constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->$em = $entityManager;
    }
    public function saveCategory(Category $category)
    {
        //save the Category!

        /* What's really cool is that you'll use these exact two following lines
        whether you're inserting a new Entity or updating an existing one.
        Doctrine figures out the right query to use.*/
        $em->persist($category); //tells Doctrine that you want to save this
        $em->flush(); //But the query isn't made until you call flush()
    }


    /* $criteria is an array e.g. ['name' => $categoryName]*/
    public function removeCategory(array $criteria)
    {
        $category = $this->$em->getRepository('InsurancesBundle:Category')->findOneBy($criteria);
        if ($category) {
            $this->$em->remove($category);
            $this->$em->flush();
        }
    }

    /*
    getCategoriesByParentId(...);
    getCategoryById(...);
    getCategoryByName(...); */
}