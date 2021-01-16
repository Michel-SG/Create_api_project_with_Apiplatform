<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="app_article", methods={"GET"})
     */
    public function articleCreate(ArticleRepository $repository, SerializerInterface $serializer): Response
    {
        $post = $repository->findAll();
        //$postNormaliser = $normalizer->normalize($post);
        //$json = json_encode($postNormaliser);
        //$json = $serializer->serialize($post, 'json');
        //$response = new Response($json, 200, [
        //    "content-type"=>"application/json"
        //]);
        //$response = new JsonResponse($json, 200, [], true);
        $response = $this->json($post, 200, []);

        return $response;
    }
}
