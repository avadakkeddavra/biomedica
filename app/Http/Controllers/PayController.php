<?php

namespace App\Http\Controllers;

use App\Model\Analysis;
use App\Model\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LiqPay;

class PayController extends Controller
{

    public function create(Analysis $analysis)
    {

        $price = $analysis->price();

        $pay = Pay::create([
            'user_id' => \Auth::user()->id,
            'analysis_id' => $analysis->id,
            'value' => $price,
            'status' => 0
        ]);

        $liqpay = new LiqPay(env('LIQPAY_PUBLIC_KEY'),env('LIQPAY_PRIVATE_KEY'));

        $link = $liqpay->getPayLink(array(
            'action'         => 'pay',
            'amount'         => $price,
            'currency'       => 'UAH',
            'description'    => $analysis->description,
            'order_id'       => $pay->id,
            'sandbox'        => '1',
            'version'        => '3'
        ));

        return redirect($link);
    }
    public function accept(Request $request)
    {
        if($request->isMethod('post'))
        {
            DB::table('pays')->insert([
                'user_id' => 1,
                'analysis_id' => 1,
                'value' => 10,
                'description' => $request->all()
            ]);
        }else{
            $liqpay = new LiqPay(env('LIQPAY_PUBLIC_KEY'),env('LIQPAY_PRIVATE_KEY'));
            $res = $liqpay->api("request", array(
                'action'        => 'status',
                'version'       => '3',
                'order_id'      => '2'
            ));
            dd($res);
        }

    }
}
