<?php
class adminIndex extends config{

	function __construct(){

		parent::__construct();
	}

    public function showCatagory(){ 
		$table='categories';
		$data['categoryData'] = $this->db->getuserdata($table);
		if( $data == true){
			extract($data);
		}
		$this->load->partial("header");
		$this->load->view("addCatagory",$data);
		$this->load->partial("footer");
	}
    public function addCatagory(){
		$category = isset($_POST["category"])? $_POST["category"]: NULL;
		$data  = array(
			'name' => $category
			);
		$table='categories';
		$result = $this->db->userInsert($table, $data);
		
		if($result==1){
			$mdata['msg'] = "Category Added Successfully!";
		}
		else{
			$mdata['msg'] = "Insertion Failed!";
		}

		session::set("msg", $mdata['msg']);

		header("Location: ".BASE_URL."/adminIndex/showCatagory");
	}


}