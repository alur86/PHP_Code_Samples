<?php

class ProductController extends BaseController
    {

    protected $layout = 'layouts.main';


    public function getIndex() {

        $products = Product::with( 'categories', 'images' )->paginate( 40 );

        return View::make( 'products.list', array( 'products' => $products ) );
    }




 public function getUpload(){

 return View::make('products.upload');
}



 public function getSuccess(){

 return View::make('products.success');
}




public function postUpload(){

        $file = Input::file('file');
        $destinationPath = public_path().'/uploads'; 
        $filename = Str::random(20) . '.' . Input::file('file')->guessExtension();
        $upload_success = Input::file('file')->move($destinationPath, $filename);
        $path_csv = $destinationPath;
        $this->_import_csv($path_csv, $filename);
       return Redirect::route('success');

}






private function _import_csv($path, $filename)   {         
  
    $csv = $path . $filename;

    $query = sprintf("LOAD DATA local INFILE '%s' INTO TABLE users FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY ',' LINES TERMINATED BY '\n' IGNORE 0 LINES (`username`,`first_name`, `last_name`,  `email` )", addslashes($csv));
   
    return DB::connection()->getpdo()->exec($query);
 }  




    public function getView( $slug ) {

        $product = Product::where( 'slug', '=', $slug )->first();

        $related_products = Product::with( 'categories', 'images' )->paginate( 40 );

        return View::make( 'products.view', array( 'product' => $product, 'related_products' => $related_products ) );
    }
    
    public function getLike( $slug ) {
        
        $json_data = array('liked'=>false);
        
        $product = Product::where( 'slug', '=', $slug )->first();
        $user = Auth::user();
        
        $like = Like::where( 'product_id', '=', $product->id )->where('user_id', '=', $user->id)->first();
        
        if( empty($like) ) {
            $new_like = new Like();
            $new_like->product_id = $product->id;
            $new_like->user_id = $user->id;
            $new_like->save();
            
            $json_data['liked'] = true;
        }
        
        if(Request::ajax()) {
            return Response::json($json_data);
        }
        
        return Redirect::back();
    }


    public function getJson() {

        //TODO: do not return all product data as json. Only title and slug!
        return Product::all();
    }
}
