<?php
/**
 * Created by PhpStorm.
 * User: jumu
 * Date: 18.01.18
 * Time: 16:31
 */

namespace jm\InsurancesBundle\Service;


use Doctrine\ORM\EntityManagerInterface;
use jm\InsurancesBundle\Entity\RelCategory;

class CategoryManager
{
    protected $entityManager;

    protected $relCategoryRepo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->relCategoryRepo = $entityManager->getRepository(RelCategory::class);
    }

    /**
     * @param $categoryId
     * @return RelCategory|null|object
     */
    public function getCategoryById($categoryId)
    {
        return $this->relCategoryRepo->findOneBy(['id' => $categoryId]);
    }

    public function getAllCategories()
    {
        return $this->relCategoryRepo->findAll();
    }

    public function getCategoryByParentId($parentId)
    {
        return $this->relCategoryRepo->findOneBy(['parent_id' => $parentId]);
    }

    public function getCategoryByName($categoryName)
    {
        return $this->relCategoryRepo->findOneBy(['name' => $categoryName]);
    }

    public function saveCategory(RelCategory $category)
    {
        $this->entityManager->persist($category); //tells Doctrine that you want to save this
        $this->entityManager->flush(); //But the query isn't made until you call flush()
    }

    public function setAllToUnselected()
    {
        $categories = $this->getAllCategories();
        foreach ($categories as $category){
            $category->setSelected(false);
        }
    }
}