<?php

namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\Upload as Upload;

class UploadController extends Controller
{
	protected $view;

	public function getUpload($request, $response)
	{
		return $this->container->view->render($response, 'upload.twig');
	}

	public function postUpload($request, $response)
	{
		$file = $request->getUploadedFiles();
		$uploadedFile = $file['uploadedFile'];

		if ($uploadedFile->getClientMediaType() != 'text/csv') {
			throw new \Exception('File upload was not successful.');
		}

		if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
			$uploadedFileName = uniqid().'.csv';
			$uploadedFile->moveTo("../public/uploads/{$uploadedFileName}");

			// Add upload to database
			if(!$upload = Upload::create([ 'fileName' => $uploadedFileName ])) {
				throw new \Exception('There was a problem saving the file in the databaese.');
			}

			$subscribers = $this->upload->parseFile($upload->id, $uploadedFileName);
			$this->subscriber->parseSubscribers($upload->id);

			$this->flash->addMessage('success', 'Your upload has been processed.');
		} else {
			$this->flash->addMessage('error', 'There was a problem processing your upload.');
		}

		return $response->withRedirect($this->router->pathFor('results'));
	}
}