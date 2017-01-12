<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Symfony\Component\HttpFoundation\File\File;

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
	 * @Route("/show/{id}", 
	 *   name="article_show",
	 *   defaults = {"id" = 1},
	 *   requirements={"id": "\d+"})
	 */
	public function showAction(Request $request, Article $article)
	{
		$articleImagePath = $article->getHeaderImage();
		$article->setHeaderImage(
			new File($this->getParameter('file_path').$articleImagePath)
		);

		return $this->render('article/show.html.twig', [
			'article' => $article,
			'articleImagePath' => $articleImagePath
		]);
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
			$this->get('image.uploader')->upload($article);
			$em = $this->getDoctrine()->getManager();

			$em->persist($article);
			// dump($article);die;
			$em->flush();


			$this->addFlash('success', "the article was successfully saved in database");

			return $this->redirectToRoute('article_homepage');
		}
		return $this->render('article/add.html.twig', ['articleForm' => $form->createView()]);
	}

	/**
	 * @Route("/update/{id}", name="article_update")
	 */
	public function updateAction(Request $request, Article $article)
	{
		$articleImagePath = $article->getHeaderImage();
		$article->setHeaderImage(
			new File($this->getParameter('file_path').$articleImagePath)
		);

		$form = $this->createForm(ArticleType::class, $article);
		$form->handleRequest($request);

		if ($form->isValid()) {
			$this->get('image.uploader')->upload($article);
			$this->getDoctrine()->getManager()->flush();

			$this->addFlash('success', "the article was successfully updated in database");

			return $this->redirectToRoute('article_homepage');
		}
		return $this->render('article/add.html.twig', [
			'articleForm' => $form->createView(),
			'article' => $article,
			'articleImagePath' => $articleImagePath
		]);
	}
}