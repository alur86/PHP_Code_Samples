<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  DB_Search extends CI_Model {



    function __construct()
    {
        parent::__construct();
    }


	public function getResults($title,$body = TRUE)
	{
	
	   $this->db->like('title',$title);
	   $this->db->order_by('title');
	   
	   $q = $this->db->get('entries');
	   
	   if ($q->num_rows() >0 ){
	
	       $result = '<ul>';
	       
	     foreach ($q->result() as $info) {
             if ($body) {
                $result .= '<li><i> Blog Article Title: </i>  '.$info->title.'</br>';
                $result .= '<i>Blog Article Body :</i>   '.$info->body.'</li>';
               } else {
	             $result .= '<li><i> Blog Article Title: </i>  '.$info->title.'</li>';
	         }
	}
	
      $result .= '</ul>';
	  return $result;
	
}
 else {

    return 'Nothing found, sorry';

 }	
 
}	

}


