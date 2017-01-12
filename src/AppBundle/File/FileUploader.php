<?php

namespace AppBundle\File;

class FileUploader
{
	private $filePath;
	private $fileWebPath;

	function __construct($filePath, $fileWebPath)
	{
		$this->filePath = $filePath;
		$this->fileWebPath = $fileWebPath;
	}

	public function upload($subject)
	{
		$file = $subject->getHeaderImage();

		$filename = md5(uniqid()).'.'.$file->guessExtension();
		$file->move($this->filePath.$this->fileWebPath, $filename);
		$subject->setHeaderImage($this->fileWebPath.'/'.$filename);

		return $subject;

	}
}