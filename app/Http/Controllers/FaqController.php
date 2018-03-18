<?php

namespace App\Http\Controllers;

use App\Model\Articles;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $articles = Articles::all();

        return view('adminlte::show.faq',['faqs' => $articles]);
    }

    public function create(Request $request)
    {
        if($request->isMethod('post')){

            $request->validate([
                'name' => 'required',
                'desc' => 'required',
                'doct' => 'required',
            ]);

            $article = Articles::create([
                'name' => $request->name,
                'description' => $request->desc,
                'docs_desc' => $request->doct
            ]);

            return response()->json(['success' => true,'data' => $article]);
        }else{
            return view('adminlte::create.faq');
        }

    }

    public function delete(Request $request)
    {
        Articles::where('id',$request->id)->delete();
        return response()->json(['success' => true]);
    }
}
