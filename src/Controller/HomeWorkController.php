<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class HomeWorkController
{
    public function appYaml()
    {
        return new Response(
            '<html><body>Yaml</body></html>'
        );
    }
}
