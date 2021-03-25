<?php


namespace App\Controllers;


class View extends BaseController
{
	public function upload_multi(): string
	{
		$files = $this->request->getFileMultiple("files");

		if ($files == null) {
			return View("/view/upload_multi", [
				'file_info_array' => []
			]);
		}

		$file_info_array = [];

		foreach ($files as $file) {
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

			array_push($file_info_array, $fileInfo);
		}

		return View("/view/upload_multi", [
			'file_info_array' => $file_info_array
		]);
	}    
}