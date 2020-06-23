<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\DbalGroupRouteLocationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

final class SingleController
{
    private $twig;
    private DbalGroupRouteLocationRepository $groupRouteLocationRepository;

    public function __construct(
        Environment $twig,
        DbalGroupRouteLocationRepository $groupRouteLocationRepository
    )
    {
        $this->twig                         = $twig;
        $this->groupRouteLocationRepository = $groupRouteLocationRepository;
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
    public function speurtocht(string $groupName)
    {
        $groupRouteLocations = $this->groupRouteLocationRepository->findAllForGroup($groupName);
        var_dump($groupRouteLocations);die;
        return new Response($this->twig->render('index.html.twig'));
    }
}
