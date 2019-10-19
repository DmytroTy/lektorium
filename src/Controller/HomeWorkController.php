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

    public function xml()
    {
        return new Response(
            '<html><body>Xml</body></html>'
        );
    }

    public function php()
    {
        return new Response(
            '<html><body>Php</body></html>'
        );
    }

    /**
     * @Route("/annotation", name="app_annotation")
     */
    public function annotation()
    {
        return $this->render('templ.html.twig');
    }
}
