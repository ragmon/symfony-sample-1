<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    /**
     * @Route("/lucky", name="lucky")
     * @return Response
     */
    public function index()
    {
        return $this->render('lucky/index.html.twig', [
            'controller_name' => 'LuckyController',
        ]);
    }

    /**
     * @Route("/lucky/{page}", name="lucky_page", requirements={"page"="\d+"})
     * @param int $page
     * @return Response
     */
    public function list(int $page)
    {
        return new Response(
            '<html><head><title>Show lucky page</title></head> <body><p>Lucky page: ' . $page . '</p></body></html>'
        );
    }

    /**
     * @Route("/lucky/{slug}", name="lucky_slug")
     * @param string $slug
     * @return Response
     */
    public function show(string $slug)
    {
        return new Response(
            '<html><head><title>Show lucky slug</title></head> <body><p>Lucky slug: ' . $slug . '</p></body></html>'
        );
    }
}
