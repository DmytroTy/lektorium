<?php

namespace App\Controller;

use App\Entity\ProjectPeople;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/projectPeople")
 */
class ProjectPeopleController extends AbstractController
{
    /**
     * @Route("/", name="projectPeople_list", methods={"GET"})
     */
    public function index(): Response
    {
        $projectPeoples = $this->getDoctrine()
            ->getRepository(ProjectPeople::class)
            ->findAll();

        if (!$projectPeoples) {
            throw $this->createNotFoundException(
                'No projectPeople found'
            );
        }

        return new Response('Check out this great projectPeoples');
    }

    /**
     * @Route("/{id}", name="projectPeople_show", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function show(int $id): Response
    {
        $projectPeople = $this->getDoctrine()
            ->getRepository(ProjectPeople::class)
            ->find($id);

        if (!$projectPeople) {
            throw $this->createNotFoundException(
                'No projectPeople found for id '.$id
            );
        }

        return new Response('Check out this great projectPeople: '.$projectPeople->getType());
    }

    /**
     * @Route("/new", name="projectPeople_create", methods={"GET"})
     */
    public function create(): Response
    {
        $projectPeople = new ProjectPeople();

        $projectPeople->setType('Type')
            ->setResponsibility('Responsibility');

        $this->getDoctrine()->getManager()->persist($projectPeople);
        $this->getDoctrine()->getManager()->flush();

        return new Response('Saved new projectPeople with id '.$projectPeople->getId());
    }

    /**
     * @Route("/{id}/edit", name="projectPeople_update", methods={"GET"})
     */
    public function update(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $projectPeople = $em->getRepository(ProjectPeople::class)->find($id);

        if (!$projectPeople) {
            throw $this->createNotFoundException(
                'No projectPeople found for id '.$id
            );
        }

        $projectPeople->setType($projectPeople->getType().' edited');
        $em->flush();

        return $this->redirectToRoute('projectPeople_show', ['id' => $projectPeople->getId()]);
    }

    /**
     * @Route("/{id}/remove", name="projectPeople_delete")
     */
    public function delete(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $projectPeople = $em->getRepository(ProjectPeople::class)->find($id);

        if (!$projectPeople) {
            throw $this->createNotFoundException(
                'No projectPeople found for id '.$id
            );
        }

        $em->remove($projectPeople);
        $em->flush();
    }
}
