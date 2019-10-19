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

    public function php(string $param)
    {
        return new Response(
            '<html><body>Php ' . $param . '</body></html>'
        );
    }

    /**
     * @Route("/annotation/{word}", name="app_annotation", requirements={"word"="[A-Za-z]+"})
     */
    public function annotation(string $word)
    {
        return $this->render('templ.html.twig', [
            'word' => $word,
        ]);
    }
}
