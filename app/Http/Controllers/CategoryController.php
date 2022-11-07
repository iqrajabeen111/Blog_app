<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use App\Http\Requests\CatogryRequest;

class CategoryController extends Controller
{
    //
     public function index()
    {
        return view('Categories');
      
    }
    
    public function create(array $data)
    {
      
      return Category::create([
        'title' => $data['title'],
       
      ]);
    }   
    public function store(CatogryRequest $request)
    {
   
        $request->validate([
            'title' => 'required',
           
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
        return redirect()->back()->with('message', 'Category Added Successfully');


    }
}
