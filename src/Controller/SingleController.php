<?php

declare(strict_types=1);

namespace App\Controller;

use App\Helper\UploadedFileHandler;
use App\Repository\DbalGroupRouteLocationRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Twig\Environment;

final class SingleController
{
    private $twig;
    private DbalGroupRouteLocationRepository $groupRouteLocationRepository;
    private RouterInterface $router;
    private UploadedFileHandler $uploadedFileHandler;

    public function __construct(
        Environment $twig,
        DbalGroupRouteLocationRepository $groupRouteLocationRepository,
        RouterInterface $router,
        UploadedFileHandler $uploadedFileHandler
    )
    {
        $this->twig                         = $twig;
        $this->groupRouteLocationRepository = $groupRouteLocationRepository;
        $this->router                       = $router;
        $this->uploadedFileHandler          = $uploadedFileHandler;
    }

    /**
     * @Route("/", name="index", methods={"GET"})
     */
    public function index(): Response
    {
        return new Response($this->twig->render('index.html.twig'));
    }

    /**
     * @Route("/{groupName}", name="speurtocht", methods={"GET", "POST"})
     */
    public function speurtocht(Request $request, string $groupName): Response
    {;
        if ($request->getMethod() === Request::METHOD_POST) {
            $groupRouteLocations = $this->groupRouteLocationRepository->findAllForGroup($groupName);
            $location            = $groupRouteLocations->findFirstUnfinished();
            if ($request->files->has('picture')) {
                $uploadedFileName = $this->uploadedFileHandler->handle($request->files->get('picture'));
                $location->uploadFile($uploadedFileName);
                $this->groupRouteLocationRepository->updatePictureUpload($location);

                return new RedirectResponse(
                    $this->router->generate('speurtocht', ['groupName' => $groupName])
                );
            } elseif ($request->request->has('answer')) {
                $location->answerAssignment($request->request->get('answer'));
                $this->groupRouteLocationRepository->updateAssignmentAnswer($location);

                return new RedirectResponse(
                    $this->router->generate('speurtocht', ['groupName' => $groupName])
                );
            }
        }

        $groupRouteLocations = $this->groupRouteLocationRepository->findAllForGroup($groupName);
        if (!$groupRouteLocations->startTime()) {
            return new Response($this->twig->render('not_started.html.twig'));
        }

        if ($groupRouteLocations->endTime()) {
            return new RedirectResponse(
                $this->router->generate('finishSpeurtocht', ['groupName' => $groupName])
            );
        }

        $firstUnfinishedLocation = $groupRouteLocations->findFirstUnfinished();
        if (!$firstUnfinishedLocation) {
            return new RedirectResponse(
                $this->router->generate('finishSpeurtocht', ['groupName' => $groupName])
            );
        }

        return new Response($this->twig->render('speurtocht.html.twig', ['location' => $firstUnfinishedLocation]));
    }

    /**
     * @Route("/{groupName}/start", name="startSpeurtocht", methods={"GET"})
     */
    public function startSpeurtocht(string $groupName): RedirectResponse
    {
        $groupRouteLocations = $this->groupRouteLocationRepository->findAllForGroup($groupName);
        if ($groupRouteLocations->startTime()) {
            return new RedirectResponse(
                $this->router->generate('speurtocht', ['groupName' => $groupName])
            );
        }
        $this->groupRouteLocationRepository->markStartedForGroup($groupName);

        return new RedirectResponse(
            $this->router->generate('speurtocht', ['groupName' => $groupName])
        );
    }

    /**
     * @Route("/{groupName}/finish", name="finishSpeurtocht", methods={"GET"})
     */
    public function finishSpeurtocht(string $groupName): Response
    {
        $groupRouteLocations     = $this->groupRouteLocationRepository->findAllForGroup($groupName);
        $firstUnfinishedLocation = $groupRouteLocations->findFirstUnfinished();
        if ($firstUnfinishedLocation) {
            return new RedirectResponse(
                $this->router->generate('speurtocht', ['groupName' => $groupName])
            );
        }

        if (!$groupRouteLocations->endTime()) {
            $this->groupRouteLocationRepository->markEndedForGroup($groupName);
        }

        $groupRouteLocations = $this->groupRouteLocationRepository->findAllForGroup($groupName);
        $groupRouteLocations->calculateWalkingTimes();

        return new Response($this->twig->render('finish.html.twig', ['groupRouteLocations' => $groupRouteLocations]));
    }
}
