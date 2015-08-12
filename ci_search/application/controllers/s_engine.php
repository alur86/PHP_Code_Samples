<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  S_Engine extends CI_Controller {

   function __construct()
       {
            parent::__construct();
            $this->load->model('db_search');


       }
       

	public function index()
	{
	
		$this->load->view('s_form');
	
	}
	
		public function search() {	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'title', 'trim|required|min_length[6]|max_length[80]|xss_clean');
        $data['page_title']="Search Results:";
	    $title = $this->input->post('title');
	    if($this->form_validation->run() == FALSE) {
           $this->load->view('s_form');
           }
         else
          {
        $data['search_results'] =$this->db_search->getResults($title);
		$this->load->view('results', $data);
	       }
	      }
	
	
	
	
}


