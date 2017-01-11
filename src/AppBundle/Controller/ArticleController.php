<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;

/**
 * @Route("/article")
 */
class ArticleController extends Controller
{
	/**
	 * @Route("/", name="article_homepage")
	 */
	public function homepageAction()
	{
		// replace this example code with whatever you need
		return $this->render('article/index.html.twig');
	}

	/**
	 * @Route("/{id}", 
	 *   name="article_show",
	 *   defaults = {"id" = 1},
	 *   requirements={"id": "\d+"})
	 */
	public function showAction()
	{
		return $this->render('article/show.html.twig');
	}

	/**
	 * @Route("/add", name="article_add")
	 */
	public function addAction(Request $request)
	{
		$article = new Article();
		$form = $this->createForm(ArticleType::class, $article);

		$form->handleRequest($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();

			$em->persist($article);
			$em->flush();

			$this->addFlash('success', "the article was successfully saved in database");

			return $this->redirectToRoute('article_homepage');
		}
		return $this->render('article/add.html.twig', ['articleForm' => $form->createView()]);
	}

	/**
	 * @Route("/update/{id}", name="article_update")
	 */
	public function updateAction(Article $article, Request $request)
	{
		$form = $this->createForm(ArticleType::class, $article);

		$form->handleRequest($request);

		if ($form->isValid()) {
			$this->getDoctrine()->getManager()->flush();

			$this->addFlash('success', "the article was successfully updated in database");

			return $this->redirectToRoute('article_homepage');
		}
		return $this->render('article/add.html.twig', [
			'articleForm' => $form->createView(),
			'article' => $article
		]);
	}
}