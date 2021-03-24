<?php


namespace App\Controllers;


class View extends BaseController
{
	public function upload(): string
	{
		$file = $this->request->getFile("single_file");

		$fileInfo = [];
		if ($file != null) {
			if (!$file->isValid()) {
				$errorString = $file->getErrorString();
				$errorCode = $file->getError();

				$fileInfo['hasError'] = true;
				$fileInfo['errorString'] = $errorString;
				$fileInfo['errorCode'] = $errorCode;

			} else {
				$fileInfo['hasError'] = false;
				if ($file->hasMoved() === false) {
					$fileInfo['mimeType'] = $file->getMimeType();

					$savedPath = $file->store();

					$fileInfo['savedPath'] = $savedPath;
					$fileInfo['clientName'] = $file->getClientName();
					$fileInfo['name'] = $file->getName();
					$fileInfo['clientMimeType'] = $file->getClientMimeType();
					$fileInfo['clientExtention'] = $file->getClientExtension();
					$fileInfo['guessExtention'] = $file->guessExtension();
				}
			}
		}

		return View("/view/upload", [
			'fileInfo' => $fileInfo
		]);
	}    
}