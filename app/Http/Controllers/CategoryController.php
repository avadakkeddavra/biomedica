<?php

namespace App\Http\Controllers;

use App\Http\Requests\Create\Category;
use Illuminate\Http\Request;
use App\Model\Categories;
use App\Http\Requests\Create\Category as CreateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {

    }

    public function show()
    {
        $categories = Categories::where('parent_id',null)->get();

        return view('adminlte::show.category',['categories' => $categories]);
    }

    public function create(Request $request)
    {
        if($request->isMethod('post'))
        {
            $category = Categories::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id
            ]);

            return response()->json(['response' => $category]);
        }else {
            $categories = Categories::where('parent_id',null)->get();
            return view('adminlte::create.category',['categories' => $categories]);
        }

    }

    public function delete(Request $request)
    {
        Categories::where('id',$request->id)->delete();

        return response()->json(['success' => true]);
    }

    public function changeName(Request $request)
    {
        $category = Categories::where('id',$request->id)->first();
        $category->update([
            'name' => $request->name
        ]);

        return response()->json(['success' => true,'response' => $category]);
    }
}
