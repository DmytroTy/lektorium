<?php

namespace App\Controller;

use App\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/company")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/", name="company_list", methods={"GET"})
     */
    public function index(): Response
    {
        $companys = $this->getDoctrine()
            ->getRepository(Company::class)
            ->findAll();

        if (!$companys) {
            throw $this->createNotFoundException(
                'No company found'
            );
        }

        return new Response('Check out this great companys');
    }

    /**
     * @Route("/{id}", name="company_show", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function show(Company $company): Response
    {
         return new Response('Check out this great company: '.$company->getTitle());
    }

    /**
     * @Route("/new", name="company_create", methods={"GET"})
     */
    public function create(EntityManagerInterface $em): Response
    {
        $company = new Company();

        $company->setTitle('Company name');

        $em->persist($company);
        $em->flush();

        return new Response('Saved new company with id '.$company->getId());
    }

    /**
     * @Route("/{id}/edit", name="company_update", methods={"GET"})
     */
    public function update(Company $company, EntityManagerInterface $em): Response
    {
        $company->setTitle($company->getTitle().' edited');

        $em->flush();

        return $this->redirectToRoute('company_show', ['id' => $company->getId()]);
    }

    /**
     * @Route("/{id}/remove", name="company_delete")
     */
    public function delete(Company $company, EntityManagerInterface $em): Response
    {
        $em->remove($company);
        $em->flush();

        return new Response('Company was deleted successfully');
    }
}
