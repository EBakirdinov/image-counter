<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Default Controller
 *
 * @Route("/")
 *
 */
class DefaultController extends AbstractController
{   

    
    /**
     * @Route("/", methods={"GET"}, name="index")
     */
    public function index(Request $request): Response
    {
        $url = $request->query->get('q');
        $images = array();
        $error = false;

        if ($url) {
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                $imgExts = array("jpg", "jpeg", "png");

                $html = file_get_contents($url);
                $crawler = new Crawler($html);
    
                $imgs = $crawler->filter('img');
                foreach ($imgs as $i => $img) {
                    $src = $img->getAttribute('src');
    
                    if (!filter_var($src, FILTER_VALIDATE_URL)) $src = $url . $src;
    
                    if ($src && in_array(pathinfo($src, PATHINFO_EXTENSION), $imgExts)) {
                        $images[] = $src;
                    };
                };
    
            } else {
                $error = true;
            };
        };

        return $this->render('index.html.twig', [
            'q' => $url,
            'images' => $images,
            'error' => $error
        ]);
    }
}

    
