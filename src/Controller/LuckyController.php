<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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

    /**
     * @Route(
     *     "/number/{max}",
     *     name="number",
     *     requirements={
     *          "max": "\d+"
     *     }
     * )
     * @param int $max
     * @param LoggerInterface $logger
     * @return Response
     */
    public function number(int $max, LoggerInterface $logger)
    {
        $number = mt_rand(0, $max);
        $baseUrl = $this->generateUrl('blog_homepage');

        $logger->info("lucky number: $number");

        return new Response(
            '<html><body>Lucky number: ' . $number . '</body><a href="' . $baseUrl . '">BaseURL</a></html>'
        );
    }

    /**
     * @Route(
     *     "/redirect",
     *     name="redirect"
     * )
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function myRedirect()
    {
        return $this->redirectToRoute('blog_homepage');
    }

    /**
     * @Route(
     *     "/json",
     *     name="json"
     * )
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function renderJson()
    {
        return $this->json([
            'value' => 'hello world',
        ]);
    }

    /**
     * @Route(
     *     "/template",
     *     name="template"
     * )
     * @return Response
     */
    public function renderTemplate()
    {
        return $this->render('lucky/index.html.twig', [
            'controller_name' => 'my controller',
        ]);
    }

    /**
     * @Route(
     *     "/request",
     *     name="request"
     * )
     * @param Request $request
     * @return Response
     */
    public function myRequest(Request $request)
    {
        $count = $request->query->count();

        return new Response(
            '<html><body>Query params count: ' . $count . '</body></html>'
        );
    }

    /**
     * @Route(
     *     "/session",
     *     name="session"
     * )
     * @param SessionInterface $session
     * @return Response
     */
    public function mySession(SessionInterface $session)
    {
        $foobar = $session->get('foo', 'default value');

        return new Response(
            "<html><body>$foobar</body></html>"
        );
    }

    /**
     * @Route(
     *     "/session_redirect",
     *     name="session_redirect"
     * )
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function mySessionRedirect(SessionInterface $session)
    {
        $session->set('foo', 'value from mySessionRedirect');

        return $this->redirectToRoute('blog_session');
    }
}
