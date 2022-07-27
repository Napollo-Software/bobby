<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Session;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request['search'] ?? "";
        if ($search != "") {

            $claims = Claim::where('id','LIKE', "%$search%")->orwhere('claim_title','LIKE', "%$search%")->orwhere('claim_category','LIKE', "%$search%")->orwhere('claim_status','LIKE', "%$search%")->orwhere('claim_amount','LIKE', "%$search%")->orwhere('submission_date','LIKE', "%$search%")->get();
            $data =  compact('claims','search');
            return view ('claims.search')->with($data);
            
        } else {

            $category = Category::orderBy('id', 'desc')->paginate(10);
            $data =  compact('category','search');
            return view ('categories.manage_categories', $data);

        }
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {

            $claims = Claim::where('id','LIKE', "%$search%")->orwhere('claim_title','LIKE', "%$search%")->orwhere('claim_category','LIKE', "%$search%")->orwhere('claim_status','LIKE', "%$search%")->orwhere('claim_amount','LIKE', "%$search%")->orwhere('submission_date','LIKE', "%$search%")->get();
            $data =  compact('claims','search');
            return view ('claims.search')->with($data);
            
        } else {

            $category = Category::orderBy('id', 'desc')->paginate(10);
            $data =  compact('category','search');
            return view ('categories.add_category', $data);

        }        
        return view ('categories.add_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request-> validate([
            'category_name'=>'required',
            'category_status'=>'required',                     
        ]);

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_staus = $request->category_status;
        $category->save();

        alert()->success('Category Added','Your category has been added successfully');

        return redirect('/category');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {

            $claims = Claim::where('id','LIKE', "%$search%")->orwhere('claim_title','LIKE', "%$search%")->orwhere('claim_category','LIKE', "%$search%")->orwhere('claim_status','LIKE', "%$search%")->orwhere('claim_amount','LIKE', "%$search%")->orwhere('submission_date','LIKE', "%$search%")->get();
            $data =  compact('claims','search');
            return view ('claims.search')->with($data);
            
        } else {
           $category = Category::find($id);
           $data =  compact('category','search');
            return view('categories.view')->with($data);
        }  

       $category = Category::find($id);
        return view('categories.view')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {

            $claims = Claim::where('id','LIKE', "%$search%")->orwhere('claim_title','LIKE', "%$search%")->orwhere('claim_category','LIKE', "%$search%")->orwhere('claim_status','LIKE', "%$search%")->orwhere('claim_amount','LIKE', "%$search%")->orwhere('submission_date','LIKE', "%$search%")->get();
            $data =  compact('claims','search');
            return view ('claims.search')->with($data);
            
        } else {

            $category = Category::find($id);
            $data =  compact('category','search');
            return view('categories.edit')->with($data);

        }          

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request-> validate([
            'category_name'=>'required',
            'category_status'=>'required',                     
        ]);

        $category = Category::find($id);
        $category->category_name = $request->category_name;
        $category->category_staus = $request->category_status;
        $category->save();

        alert()->success('Category Updated','Your category has been updated successfully');

        return redirect('/category'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
    }
}
