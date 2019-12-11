<?php

namespace App\Controller;

use App\Entity\Department;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/department")
 */
class DepartmentController extends AbstractController
{
    /**
     * @Route("/", name="department_list", methods={"GET"})
     */
    public function index(): Response
    {
        $departments = $this->getDoctrine()
            ->getRepository(Department::class)
            ->findAll();

        if (!$departments) {
            throw $this->createNotFoundException(
                'No department found'
            );
        }

        return new Response('Check out this great departments');
    }

    /**
     * @Route("/{id}", name="department_show", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function show(Department $department): Response
    {
        return new Response('Check out this great department: '.$department->getTitle());
    }

    /**
     * @Route("/new", name="department_create", methods={"GET"})
     */
    public function create(): Response
    {
        $department = new Department();

        $department->setTitle('Department name')
            ->setDescription('Description');

        $this->getDoctrine()->getManager()->persist($department);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Saved new department with id '.$department->getId());
    }

    /**
     * @Route("/{id}/edit", name="department_update", methods={"GET"})
     */
    public function update(Department $department): Response
    {
        $department->setTitle($department->getTitle().' edited');

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('department_show', ['id' => $department->getId()]);
    }

    /**
     * @Route("/{id}/remove", name="department_delete")
     */
    public function delete(Department $department): Response
    {
        $this->getDoctrine()->getManager()->remove($department);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Department was deleted successfully');
    }
}
