<?php

class ReviewController extends BaseController{

    public function index(){
        $reviews=Review::orderby('updated_at','desc')->paginate(20);
        return View::make('backend.review.index')
            ->with('reviews', $reviews);
    }

    public function search(){
        $search="%".Input::get('search')."%";
        $where="url LIKE ? OR author LIKE ? OR snippet LIKE ? OR domain LIKE ? OR image LIKE ? OR blog_name LIKE ?";
        $count=substr_count($where,'?');
        $searchArray=[];

        //match the amount of fields in the where statement
        //count the "?"
        for($i=$count;$i>0;$i--){
            array_push($searchArray,$search);
        }
        $reviews=Review::whereraw($where,$searchArray)->orderby('updated_at','desc')->paginate(20);//->or_where('type','LIKE',$search);
        //$reviews=Review::whereraw($where,$searchArray)->paginate(20);//->or_where('type','LIKE',$search);
        return View::make('backend.review.index')->with('reviews',$reviews);
    }

    public function create(){
        return View::make('backend.review.create');
    }

    public function store(){
        $input=Input::get();
        unset($input['_token']);
        unset($input['submit']);
        Review::create($input);
        return Redirect::route('review_index');
    }

    public function edit($id){
        $review=Review::find($id);
        return View::make('backend.review.edit')
            ->with('review',$review);
    }

    public function update(){
        $input=Input::get();
        unset($input['_method']);
        unset($input['_token']);
        unset($input['submit']);
        $id = $input['id'];

        $review= Review::find($input['id']);
        $review->update($input);
        return Redirect::route('review_index');
    }
}