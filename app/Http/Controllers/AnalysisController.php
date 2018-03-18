<?php

namespace App\Http\Controllers;

use App\Model\Cities;
use App\Model\Prices;
use Illuminate\Http\Request;
use App\Model\Categories;
use App\Model\Analysis;
use App\Model\Articles;

class AnalysisController extends Controller
{
    public function index(Request $request)
    {

    }

    public function show()
    {
        $analysis = Analysis::all();

        return view('adminlte::show.analysis',['analysis' => $analysis]);
    }

    public function create(Request $request)
    {
        if($request->isMethod('post'))
        {
            $request->validate([
                'name' => 'required',
                'cat_id' => 'required|exists:categories,id',
                'article_id' => 'required|exists:articles,id',
                'status' => 'required',
                'description' => 'required'
            ]);


            $analysis = Analysis::create([
                'name' => $request->name,
                'cat_id' => $request->cat_id,
                'article_id' => $request->article_id,
                'status' => $request->status,
                'description' => $request->description,
                'doct_desc' => $request->doct
            ]);


            foreach($request->prices as $price)
            {
                if($price['value'] != '')
                {
                    Prices::create([
                        'city_id' => $price['key'],
                        'analysis_id' => $analysis->id,
                        'value' => $price['value']
                    ]);
                }

            }

            return response()->json(['success' => true,'response' => $analysis]);
        }else {

            $categories = Categories::all();
            $articles = Articles::all();
            $cities = Cities::all();

            return view('adminlte::create.analysis',['categories' => $categories,'articles' => $articles,'cities' => $cities]);
        }

    }
}
