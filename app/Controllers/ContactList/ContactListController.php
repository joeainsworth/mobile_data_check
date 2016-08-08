<?php

namespace App\Controllers;

use Slim\Views\Twig as View;
use App\Models\ContactList as ContactList;

class ContactListController extends Controller
{
	protected $view;

	public function getContactList($request, $response)
	{
		return $this->container->view->render($response, 'upload.twig');
	}

	public function postContactList($request, $response)
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
			if(!$upload = ContactList::create([ 'fileName' => $uploadedFileName ])) {
				throw new \Exception('There was a problem saving the file in the databaese.');
			}

			$subscribers = $this->contactlist->parseFile($upload->id, $uploadedFileName);
			$this->subscriber->parseSubscribers($upload->id);

			$this->flash->addMessage('success', 'Your upload has been processed and the results are displayed below.');
		} else {
			$this->flash->addMessage('error', 'There was a problem processing your upload.');
		}

		return $response->withRedirect($this->router->pathFor('results'));
	}
}