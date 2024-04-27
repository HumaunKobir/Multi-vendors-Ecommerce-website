<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Section;
use Session;

class CategoryController extends Controller
{
    public function categories(){
        Session::put('page','categories');
        $categories = Category::with(['section','parentcategory'])->get()->toArray();
        // dd($categories);
        return view('admin.categories.categories')->with(compact('categories'));
    }
    //Delete Category
    public function deleteCategory($id){
       $category=Category::where('id',$id)->first();
        //Get Image path
        $imagePath = 'front/images/category_image/';
        if(file_exists($imagePath.$category->category_image)){
            unlink($imagePath.$category->category_image);
        }
        Category::where('id',$id)->delete();
        return redirect()->back()->with('success_message','Category Deleted Successfully!');
    }
     //Update Category Status
     public function updateCategoryStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Category::where('id',$data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        }
    }
    //Add Edit Categories
    public function addEditCategory(Request $request,$id=null){
        Session::put('page','categories');
        if($id==""){
            //Add Category
            $title = "Add Category";
            $category = new Category;
            $getCategories = array();
            $message = "Category Added Successfully!";
        }else{
            //Edit Category
            $title = "Edit Category";
            $category = Category::find($id);
            $getCategories = Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$category['section_id']])->get();
            $message = "Category Updated Successfully!";
        }

        //Add and Update Categories
        if($request->isMethod('post')){
            $data = $request->all();
            //Data Validation
            $rules = ([
                'category_name'=> 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' =>'required',
                'url' =>'required',
            ]);
            $this->validate($request,$rules);
            if($data['category_discount'] || $data['description']==""){
                $data['category_discount']=0;
                $data['description']=0;
            }
                //Upload Category Picture
                if($request->hasFile('category_image')){
                    $image_tmp = $request->file('category_image');
                    if($image_tmp->isValid()){
                        //Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate New Image Name
                        $image_name = time().'-'.$request->category_name .'.'.$extension;
                        $request->category_image->move(public_path('front/images/category_images'),$image_name);
                        $category->category_image = $image_name;    
                    }
                }
                $category->parent_id = $data['parent_id'];
                $category->section_id = $data['section_id'];
                $category->category_name = $data['category_name'];
                $category->category_discount = isset($data['category_discount']) ? $data['category_discount'] : "0";
                $category->description = isset($data['description']) ? $data['description'] : "-";
                $category->url = $data['url'];
                $category->meta_title = isset($data['meta_title']) ? $data['meta_title'] : "-";
                $category->meta_description = isset($data['meta_description']) ? $data['meta_description'] : "-";
                $category->meta_keywords = isset($data['meta_keywords']) ? $data['meta_keywords'] : "-";
                $category->status = 1;
                $category->save();

                return redirect('admin/categories')->with('success_message',$message);

        }
        //Get All Section
        $getSections = Section::get()->toArray();
        return View('admin.categories.add_edit_category')->with(compact('title','category','getSections','getCategories'));
    }
    //Append Categories Lavel
    public function appendCategoriesLavel(Request $request){
        if($request->ajax()){
        $data = $request->all();
        $getCategories = Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$data['section_id']])->get()->toArray();
        return View('admin.categories.append_categories_lavel')->with(compact('getCategories'));
        }  

    }
}
