<?php

class DomainListController extends BaseController{

    public function index(){
        $domainList=DomainList::paginate(20);
        return View::make('backend.domain_list.index',['domainList'=>$domainList]);
    }

    public function search(){
        $search="%".Input::get('search')."%";
        $domainList=DomainList::whereraw("domain LIKE ? OR type LIKE ?",[$search,$search])->paginate();//->or_where('type','LIKE',$search);
        return View::make('backend.domain_list.index')->with('domainList',$domainList);
    }

    public function create(){
        return View::make('backend.domain_list.create');
    }

    public function store(){
        $input=$this->getInput();
        DomainList::create($input);
        return Redirect::route('domain_list_index');
    }

    public function edit($id){
        $domain=DomainList::find($id);
        return View::make('backend.domain_list.edit')
            ->with('domain',$domain);
    }

    public function update(){
        $input=$this->getInput();
        $id = $input['id'];
        $domain= DomainList::find($input['id']);
        $domain->update($input);
        return Redirect::route('domain_list_index');
    }

    public function destroy($id){
        return DebugService::display("Method");
    }

}