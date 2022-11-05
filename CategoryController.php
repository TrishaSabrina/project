<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function index(){

    
       $categories= Category::all();//->toArray();
       foreach($categories as $category){
          //echo $category->name."<br>";

       }
       //exit;

     //dd($categories);

      $data=Category::all();
     return view('admin.category.index',['categories'=>$data]);

       
     }

    public function create(){

       // echo  'hsbdhsf';
       return view('admin.category.create');
      
    }

     public function store(Request $request){
        //echo 'Test'; exit; 
        
        $request->validate([
            'name'=>'required|max:255'
        ]);

        //Category::create([
           $created=Category::create([
            'name'=> $request->name,
            'slug'=>Str::slug($request->name)
        ]);

        if($created){
            return redirect()->back()->with('success','Category Created Successfully.');
        }
    }
        
    public function edit($id){
        $data=Category::find($id);
        return view('admin.category.edit',['category'=>$data]);
   
    }


    public function update(Request $request, $id){
        //echo $id; exit; 
        
        $request->validate([
            'name'=>'required|max:255'
        ]);    


      $category=Category::find($id);
      $category->name=$request->name;
      $category->slug= Str::slug($request->name);
      //$category->Update();
      $updated=$category->Update();

      if($updated){
          return redirect()->back()->with('success','Category Updated Successfully.');
      }
    }

    public function destroy($id){
        $deleted=Category::destroy($id);
        if($deleted){
            return redirect()->back()->with('success','Category Deleted Successfully.');
        }
    }

   
}
