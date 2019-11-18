<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/project")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="project_list", methods={"GET"})
     */
    public function index(): Response
    {
        $projects = $this->getDoctrine()
            ->getRepository(Project::class)
            ->findAll();

        if (!$projects) {
            throw $this->createNotFoundException(
                'No project found'
            );
        }

        return new Response('Check out this great projects');
    }

    /**
     * @Route("/{id}", name="project_show", requirements={"id"="\d+"}, methods={"GET"})
     */
    public function show(Project $project): Response
    {
        return new Response('Check out this great project: '.$project->getTitle());
    }

    /**
     * @Route("/new", name="project_create", methods={"GET"})
     */
    public function create(EntityManagerInterface $em): Response
    {
        $project = new Project();

        $project->setTitle('Project name')
            ->setDescription('Description');

        $em->persist($project);
        $em->flush();

        return new Response('Saved new project with id '.$project->getId());
    }

    /**
     * @Route("/{id}/edit", name="project_update", methods={"GET"})
     */
    public function update(Project $project, EntityManagerInterface $em): Response
    {
        $project->setTitle($project->getTitle().' edited');

        $em->flush();

        return $this->redirectToRoute('project_show', ['id' => $project->getId()]);
    }

    /**
     * @Route("/{id}/remove", name="project_delete")
     */
    public function delete(Project $project, EntityManagerInterface $em): Response
    {
        $em->remove($project);
        $em->flush();

        return new Response('Project was deleted successfully');
    }
}
