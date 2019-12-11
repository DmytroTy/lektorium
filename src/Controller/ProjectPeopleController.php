<?php

namespace App\Controller;

use App\Entity\ProjectPeople;
use Doctrine\ORM\EntityManagerInterface;
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
    public function show(ProjectPeople $projectPeople): Response
    {
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
    public function update(ProjectPeople $projectPeople): Response
    {
        $projectPeople->setType($projectPeople->getType().' edited');

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('projectPeople_show', ['id' => $projectPeople->getId()]);
    }

    /**
     * @Route("/{id}/remove", name="projectPeople_delete")
     */
    public function delete(ProjectPeople $projectPeople): Response
    {
        $this->getDoctrine()->getManager()->remove($projectPeople);
        $this->getDoctrine()->getManager()->flush();

        return new Response('ProjectPeople was deleted successfully');
    }
}
