<?php
/**
 * Created by PhpStorm.
 * User: jumu
 * Date: 18.01.18
 * Time: 16:31
 */

namespace jm\InsurancesBundle\Service;


use Doctrine\ORM\EntityManagerInterface;
use jm\InsurancesBundle\Entity\RelInsurance;

class InsuranceManager
{
    protected $entityManager;

    protected $relInsuranceRepo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->relInsuranceRepo = $entityManager->getRepository(RelInsurance::class);
    }

    public function getInsByCategory(RelCategory $category)
    {
        return $category->getProducts();
    }

    public function getInsByName( $insuranceName)
    {
        return $this->relInsuranceRepo->findOneBy(['name' => $insuranceName]);
    }

    public function getInsById( $insuranceId)
    {
        return $this->relInsuranceRepo->findOneBy(['id' => $insuranceId]);
    }

    public function saveInsurance(RelInsurance $insurance)
    {
        $this->entityManager->persist($insurance); //tells Doctrine that you want to save this
        $this->entityManager->flush(); //But the query isn't made until you call flush()
    }

}