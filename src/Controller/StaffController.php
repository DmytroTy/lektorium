<?php

namespace App\Controller;

use App\Entity\Staff;
use Doctrine\ORM\EntityManagerInterface;
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
    public function show(Staff $staff): Response
    {
        return new Response('Check out this great staff: '.$staff->getFullName());
    }

    /**
     * @Route("/new", name="staff_create", methods={"GET"})
     */
    public function create(EntityManagerInterface $em): Response
    {
        $staff = new Staff();

        $staff->setFullName('Staff name')
            ->setEmail('Email')
            ->setPhone('Phone')
            ->setCreatedAt(null)
            ->setSkills('Skills');

        $em->persist($staff);
        $em->flush();

        return new Response('Saved new staff with id '.$staff->getId());
    }

    /**
     * @Route("/{id}/edit", name="staff_update", methods={"GET"})
     */
    public function update(Staff $staff, EntityManagerInterface $em): Response
    {
        $staff->setFullName($staff->getFullName().' edited');

        $em->flush();

        return $this->redirectToRoute('staff_show', ['id' => $staff->getId()]);
    }

    /**
     * @Route("/{id}/remove", name="staff_delete")
     */
    public function delete(Staff $staff, EntityManagerInterface $em): Response
    {
        $em->remove($staff);
        $em->flush();

        return new Response('Staff was deleted successfully');
    }
}
