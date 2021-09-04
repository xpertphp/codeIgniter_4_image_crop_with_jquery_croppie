<?php 

namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\StudentModel;
 
class Student extends Controller
{
 
	public function __construct()
    {
       helper(['form', 'url']); 
    }
    public function index()
    {   
		return view('add');
    }    
	public function store()
    { 
		$data = $_POST['image'];
		if(!empty($data)){
			
			$img_arr_a = explode(";", $data);
			$img_arr_b = explode(",", $img_arr_a[1]);
 
			$data = base64_decode($img_arr_b[1]);
			$image_name = time() . '.png';
			$path =  WRITEPATH . 'uploads/'. $image_name;

			file_put_contents($path, $data);
			
			$saveData = [
			 'image'  => $image_name,
			 ];
			 
			$model = new StudentModel(); 
			$save = $model->insert($saveData);

			return json_encode(['status' => 1, 'message' => "Image uploaded successfully"]);
		}
		
    }
 
}
?>