<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeWorkController extends AbstractController
{
    public function yaml()
    {
        return new Response(
            '<html><body>Yaml</body></html>'
        );
    }

    /**
     * @Route("/annotation")
     */
    public function annotation()
    {
        return $this->render('templ.html.twig');
    }
}
