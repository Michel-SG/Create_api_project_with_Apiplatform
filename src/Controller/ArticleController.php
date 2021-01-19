<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
//use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface; 
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="app_article", methods={"GET"})
     */
    public function GetArticle( ArticleRepository $repository, SerializerInterface $serializer): Response
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

    /**
     * @Route("/article", name="app_article_post", methods={"POST"})
     */
     public function CreateArticle(ValidatorInterface $validator, Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
     {
        try{
            $json = $request->getContent();
            $post = $serializer->deserialize($json, Article::class, 'json');

            $error = $validator->validate($post);
            if(count($error)>0){
                return $this->json($error,400);
            }

            $em->persist($post);
            $em->flush();
            $response = $this->json($post, 201, []);
            return $response;
        }catch(NotEncodableValueException $e){
            return $this->json([
                'status'=>400,
                'message'=>$e->getMessage()
            ]);

        }
     }

}
