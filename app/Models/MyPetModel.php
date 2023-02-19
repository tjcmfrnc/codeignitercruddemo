<?php 

namespace App\Models;
use CodeIgniter\Database\connectionInterface;
use CodeIgniter\Model;


class MyPetModel extends Model
{
    protected $table = 'MyPet';
    protected $allowedFields = ['name', 'species', 'breed', 'address'];

    public function __construct(){
        parent::__construct();
        //$this->load->database();
        $db = \Config\Database::connect();
        $builder = $db->table('MyPet');
    }

    public function insert_data($data) {
        if($this->db->table($this->table)->insert($data))
        {
            return $this->db->insertID();
        }
        else
        {
            return false;
        }
    }

}
?>