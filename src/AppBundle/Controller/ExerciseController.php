<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExerciseController extends Controller
{
    /**
     * @Route("/test", name="users")
     */
    public function testAction()
    {
        //return new Response('Hello', Response::HTTP_INTERNAL_SERVER_ERROR, ["X-My-Header" => "Youhou"]);
        return new Response(
            $this->renderView('exercise/exercise.html.twig'), Response::HTTP_OK, ["X-My-Header" => "Youhou"]);
    }
}