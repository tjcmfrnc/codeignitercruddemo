<?php 
  
namespace App\Controllers;
   
use CodeIgniter\Controller;
use App\Models\MyPetModel;

   
class MyPet extends Controller
{
    protected $mRequest;
    public function __construct()
    {
        $this->mRequest = service("request");
    }
    public function index()
    {    
        $model = new MyPetModel();
   
        $data['MyPet_detail'] = $model->orderBy('id', 'DESC')->findAll();
          
        return view('list', $data);
    }    
  
   
    public function store()
    {  
        helper(['form', 'url']);
           
        $model = new MyPetModel();
          
        $data = [
            'name' => $this->mRequest->getVar('txtName'),
            'species'  => $this->mRequest->getVar('txtSpecies'),
            'breed'  => $this->mRequest->getVar('txtBreed'),
            'address'  => $this->mRequest->getVar('txtAddress'),
            ];
        $save = $model->insert_data($data);
        if($save != false)
        {
            $data = $model->where('id', $save)->first();
            echo json_encode(array("status" => true , 'data' => $data));
        }
        else{
            echo json_encode(array("status" => false , 'data' => $data));
        }
    }
   
    public function edit($id = null)
    {
        
     $model = new MyPetModel();
      
     $data = $model->where('id', $id)->first();
       
    if($data){
            echo json_encode(array("status" => true , 'data' => $data));
        }else{
            echo json_encode(array("status" => false));
        }
    }
   
    public function update()
    {  
   
        helper(['form', 'url']);
           
        $model = new MyPetModel();
  
        $id = $this->mRequest->getVar('hdnMyPetId');
  
         $data = [
            'name' => $this->mRequest->getVar('txtName'),
            'species'  => $this->mRequest->getVar('txtSpecies'),
            'breed'  => $this->mRequest->getVar('txtBreed'),
            'address'  => $this->mRequest->getVar('txtAddress'),
            ];
  
        $update = $model->update($id,$data);
        if($update != false)
        {
            $data = $model->where('id', $id)->first();
            echo json_encode(array("status" => true , 'data' => $data));
        }
        else{
            echo json_encode(array("status" => false , 'data' => $data));
        }
    }
   
    public function delete($id = null){
        $model = new MyPetModel();
        $delete = $model->where('id', $id)->delete();
        if($delete)
        {
           echo json_encode(array("status" => true));
        }else{
           echo json_encode(array("status" => false));
        }
    }
}
  
?>