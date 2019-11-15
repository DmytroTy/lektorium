<?php

namespace App\Controller;

use App\Entity\Staff;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/staff")
 */
class StaffController extends AbstractController
{
    /**
     * @Route("/", name="staff_list", methods={"GET"})
     */
    public function index(): Response
    {
        $staffs = $this->getDoctrine()
            ->getRepository(Staff::class)
            ->findAll();

        if (!$staffs) {
            throw $this->createNotFoundException(
                'No staff found'
            );
        }

        return new Response('Check out this great staffs');
    }

    /**
     * @Route("/{id}", name="staff_show", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function show(int $id): Response
    {
        $staff = $this->getDoctrine()
            ->getRepository(Staff::class)
            ->find($id);

        if (!$staff) {
            throw $this->createNotFoundException(
                'No staff found for id '.$id
            );
        }

        return new Response('Check out this great staff: '.$staff->getFullName());
    }

    /**
     * @Route("/new", name="staff_create", methods={"GET"})
     */
    public function create(): Response
    {
        $staff = new Staff();

        $staff->setFullName('Staff name')
            ->setEmail('Email')
            ->setPhone('Phone')
            ->setCreatedAt(null)
            ->setSkills('Skills');

        $this->getDoctrine()->getManager()->persist($staff);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Saved new staff with id '.$staff->getId());
    }

    /**
     * @Route("/{id}/edit", name="staff_update", methods={"GET"})
     */
    public function update(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $staff = $em->getRepository(Staff::class)->find($id);

        if (!$staff) {
            throw $this->createNotFoundException(
                'No staff found for id '.$id
            );
        }

        $staff->setTitle($staff->setTitle().' edited');
        $em->flush();

        return $this->redirectToRoute('staff_show', ['id' => $staff->getId()]);
    }

    /**
     * @Route("/{id}/remove", name="staff_delete")
     */
    public function delete(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $staff = $em->getRepository(Staff::class)->find($id);

        if (!$staff) {
            throw $this->createNotFoundException(
                'No staff found for id '.$id
            );
        }

        $em->remove($staff);
        $em->flush();
    }
}
