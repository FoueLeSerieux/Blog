<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleType extends AbstractType
{
	
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('title', TextType::class, [
				'attr' => ['placeholder' => "The title of the article"]
			])
			->add('headerImage', FileType::class, ['label' => "upload the header image"])
			->add('author')
			->add('content')
		;

	}
}