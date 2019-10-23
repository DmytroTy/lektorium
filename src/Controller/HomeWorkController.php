<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

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
        return $this->json(['route' => 'xml', 'response' => 'JSON']);
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
        $number = random_int(0, 100);
        $url = $this->generateUrl('app_php', ['param' => $number]);

        return $this->render('templ.html.twig', [
            'word' => $word,
            'url' => $url,
        ]);
    }

    /**
     * @Route("/redirect", name="app_redirect")
     */
    public function index()
    {
        return $this->redirectToRoute('app_annotation', ['word' => 'word'], 301);
    }
}
