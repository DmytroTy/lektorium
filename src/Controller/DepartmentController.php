<?php

namespace App\Controller;

use App\Entity\Department;
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
    public function show(int $id): Response
    {
        $department = $this->getDoctrine()
            ->getRepository(Department::class)
            ->find($id);

        if (!$department) {
            throw $this->createNotFoundException(
                'No department found for id '.$id
            );
        }

        return new Response('Check out this great department: '.$department->getTitle());
    }

    /**
     * @Route("/new", name="department_create", methods={"GET"})
     */
    public function create(): Response
    {
        $department = new Department();

        $department->setTitle('Department name')
            ->setDescription('Description')
            ->setTeamLead('TeamLead');

        $this->getDoctrine()->getManager()->persist($department);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Saved new department with id '.$department->getId());
    }

    /**
     * @Route("/{id}/edit", name="department_update", methods={"GET"})
     */
    public function update(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $department = $em->getRepository(Department::class)->find($id);

        if (!$department) {
            throw $this->createNotFoundException(
                'No department found for id '.$id
            );
        }

        $department->setTitle($department->getTitle().' edited');
        $em->flush();

        return $this->redirectToRoute('department_show', ['id' => $department->getId()]);
    }

    /**
     * @Route("/{id}/remove", name="department_delete")
     */
    public function delete(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $department = $em->getRepository(Department::class)->find($id);

        if (!$department) {
            throw $this->createNotFoundException(
                'No department found for id '.$id
            );
        }

        $em->remove($department);
        $em->flush();
    }
}
