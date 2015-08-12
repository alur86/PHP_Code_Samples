<?php


class NetworksController extends BaseController {


  public $restful = true;
  protected $layout = "layouts.default";
 
   /**
	 * Display all data on the index view.
	 *
	 * @return mixed
	 */


	public function index()
	{	
     

         $networks = DB::connection('My Connection')->collection('networks')->get();

         $this->layout->content = View::make('networks.index')->with('networks', $networks);



	}



    
   /**
	 * Show the form for edit of selected item.
	 * @param int $id
	 *
	 * @return mixed
	 */



  public function edit($nid) {

 $network = Network::find($nid);

 return View::make ('networks.edit')->with('network', $network);



  }

 



   /**
	 * Create new item.
	 *
	 * @return mixed
	 */



  public function create() {

  $rules =array(

  	'n_name'=>'required', 
    'n_ip'=>'required',
     'n_status'=>'required'
  	);


     $validators = Validator::make(Input::all(), $rules);

                if ($validator->fails()) {
                

                return Redirect::to('networks/create')->withErrors($validators);
                
                } 

                 else {

                 $network = new Network;
                 $network->n_name = Input::get('n_name');
                 $network->n_ip = Input::get('n_ip'); 
                 $network->n_status = Input::get('n_status');
                 $network->save(); 


             return Redirect::to('networks/index')->with('message', 'New item was saved ok!');

        }


  }



   /**
	 * Create new item.
	 *
	 * @return mixed
	 */



  public function save() {


  return View::make ('networks.index');


  }



  
   /**
	 * Show the form for edit of selected item.
	 * @param int $id
	 *
	 * @return mixed
	 */


  public function update($nid){


     $network = Network::find($nid);
     $network->n_name = Input::get('n_name');
     $network->n_ip = Input::get('n_ip'); 
     $network->n_status = Input::get('n_status');
     $network->save(); 

   return View::make ('networks.show')->with('network', $network);


  }


  /**
	 * Show the selected item.
	 * @param int $id
	 *
	 * @return mixed
	 */



 public function show($nid){

 $network = Network::find($nid);

 return View::make ('networks.show')->with('network', $network);

  }





  /**
	 * Delete the selected item.
	 * @param int $id
	 *
	 * @return mixed
	 */



 public function destroy($nid){

 $network = Network::find($nid);
 $network->delete();

 Session::flash ('message', 'Item was deleted well!');

 return View::make ('networks.index');


 }







}