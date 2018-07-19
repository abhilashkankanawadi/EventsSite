<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;

class PromotionController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function show($id)
  {
    $promo  = Promotion::where('event_id',$id)->OrderBy('start_date','ASC')->get();
    return view('promotions.Promotion',['promo'=>$promo,'id'=>$id]);
  }
  public function store(Request $request,$id)
  {
    $add  = new Promotion;
    $add->name         = $request->name;
    $add->description  = $request->description;
    $add->url          = $request->url;
    $add->start_date   = $request->start_date;
    $add->event_id     = $request->id;
    $add->user_id      = $request->user()->id;
    $add->save();
    return redirect()->action('PromotionController@show',['id'=>$id]);
  }
}
