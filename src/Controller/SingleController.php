<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

final class SingleController
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index()
    {
        return new Response($this->twig->render('index.html.twig'));
    }

    /**
     * @Route("/{groupName}", name="speurtocht", methods={"GET"})
     */
    public function speurtocht()
    {
        return new Response($this->twig->render('index.html.twig'));
    }
}
