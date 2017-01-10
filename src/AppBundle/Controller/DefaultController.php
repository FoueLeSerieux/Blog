<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
	/**
	 * @Route("/", name="homepage")
	 */
	public function indexAction(Request $request)
	{
		// replace this example code with whatever you need
		return $this->render('default/index.html.twig', [
			'base_dir' => 'Hello',
		]);
	}

	/**
	 * @route("/{id}", name="show_article")
	 */
	public function showAction(Request $request, $id)
	{
		dump($id);

		return $this->render('default/show.html.twig');
	}
}
