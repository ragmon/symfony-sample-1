<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class LuckyController
 *
 * @package App\Controller
 *
 * @Route("/blog", requirements={"_locale": "en|es|fr"}, name="blog_")
 */
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

    /**
     * @Route(
     *     "/lucky/search",
     *     locale="en",
     *     format="html",
     *     priority=2,
     *     defaults={
     *          "query": "default value",
     *     },
     *     requirements={
     *          "_locale": "en|fr",
     *          "_format": "html|xml",
     *     }
     * )
     * @param string $query
     * @return Response
     */
    public function search(string $query)
    {
        return new Response(
            'Your search query: ' . $query
        );
    }

    /**
     * @Route({
     *     "en": "/about-us",
     *     "nl": "/over-ons"
     * }, name="about_us")
     * @return Response
     */
    public function about()
    {
        return new Response(
            '<html><head><title>about</title></head><body>my about page</body></html>'
        );
    }

    /**
     * @Route(
     *     "/",
     *     name="homepage",
     *     stateless=true
     * )
     * @return Response
     */
    public function homepage()
    {
        return new Response(
            'hello from homepage without caching'
        );
    }

    /**
     * @Route(
     *     "/http_route",
     *     name="http_route",
     *     schemes={"http"}
     * )
     * @return Response
     */
    public function httpRoute()
    {
        return new Response(
            'hello from http response'
        );
    }
}
