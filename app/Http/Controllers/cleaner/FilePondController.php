<?php


namespace App\Http\Controllers\cleaner;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
class FilePondController extends Controller
{   
	/* This Function accept the file Name and upload into a folder*/
	public function uploadFile($data)
	{
		// Create variable for each element in array
		extract($data);
		// Upload
		
		if (!empty($file)) {
			$fileExt = $file->getClientOriginalExtension();
			/*Image Upload*/
			$fileName = time() . str_random(5) . '.' . $file->getClientOriginalExtension();
			$path = public_path($path);
			$file->move($path, $fileName);
			return $fileName;
		}
		return "Empty";
	}

	/* This Function accept the file and give the path according to condition and return full path and Image Name */

	public function uploadImage(Request $request)
	{
		

		if ($_SERVER['HTTP_HOST'] == '127.0.0.1:8000') {
			$imagePath = '/images/';
		} else {
			$imagePath = '../../public_html/housekeeper/images/';
		}


		if($request->base64){
			$image = str_replace('data:image/png;base64,', '', $request->base64);
			$image = str_replace(' ', '+', $image);
			$fileName = str_random(5) . '.png';
			$path = public_path($imagePath);
			Storage::disk('public_driver')->put($fileName, base64_decode($image));
			return $fileName;

	}
		else{
			$image = $request->file('image');
			echo $this->uploadFile(['file' => $image, 'path' => $imagePath]);
		}

	}
	/* This Function is delete the upload file from disk while uploading */

	public function deleteImage(Request $request)
	{


		if ($_SERVER['HTTP_HOST'] == '127.0.0.1:8000') {
			$imagePath = '/images/';
		} else {
			$imagePath = '../../public_html/housekeeper/images/';
		}

		$payLoad = request()->getContent();
		$destinationPath = public_path($imagePath . $payLoad);
		unlink($destinationPath);
	}
}
