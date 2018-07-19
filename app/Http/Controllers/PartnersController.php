<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Partners;
use App\PartnershipCategory;
use App\User;
use Validator;
use Illuminate\Support\Facades\DB;
use Auth;

class PartnersController extends Controller
{
  public function index(Manager $fractal, PartnerTransformer $PartnerTransformer)
  {
    $display      = Partners::all();
    return view('Partners',['partner'=>$partner,'id'=>$id]);
  }
  public function show($id)
  {
    $partner = Partners::where('event_id',$id)->OrderBy('company_name','ASC')->get();
    //$partnerCat = PartnershipCategory::where('event_id',$id)->with('partner')->get();
    $partnerCategory = PartnershipCategory::where('event_id',$id)->get();

     $testing = DB::table('partners')
    ->join('partnership_categories','partners.partnership_category_id', '=', 'partnership_categories.id')
    ->select('partners.*', 'partnership_categories.*')
    ->where('partnership_categories.event_id','=',$id)
    ->get();

    return view('Partners',['partner'=>$partner,'partnerCategory'=>$partnerCategory,'testing'=>$testing,'id'=>$id]);
  }
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(),[
      'first_name'            => 'required',
      'last_name'             => 'required',
      'company_name'          => 'required',
      'phone'                 => 'required|unique:partners',
      'company_logo'          => 'image|mimes:jpg,png,gif,jpeg|max:2048|dimensions:max_width=800,max_height=800',
      ]);
      if ($validator->fails()) {
            return $validator->errors()->all();
        }
    $user  = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['admin','organiser','agency']) && $user->can('create')) {
      $add                            = new Partners;
      $add->first_name                = $request->first_name;
      $add->last_name                 = $request->last_name;
      $add->designation               = $request->designation;
      $add->company_name              = $request->company_name;
      $add->website                   = $request->website;
      $add->postalAddress             = $request->postalAddress;
      $add->pinCode	                  = $request->pinCode;
      $add->phone                     = $request->phone;
      $add->city                      = $request->city;
      $add->state                     = $request->state;
      $add->country                   = $request->country;
      $add->partnership_category_id   = $request->partnership_category_id;
      $add->user_id                   = $request->user()->id;
      $add->event_id                  = $request->event_id;
      if ($request->hasFile('company_logo')) {
        $image = $request->file('company_logo')->store('public/images');
        $add->company_logo = str_replace('public/images/','',$image);
      }
      $add->save();
      return response()->json(['OK'=>'Values are Stored Successfully!!!','status'=>'200']);
    }
    else {
      return response()->json(['message'=>'Permission Denied!','status'=>403]);
    }
  }
  public function update(Request $request,$id)
  {
    $user  = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['admin','organiser','agency']) && $user->can('create')) {
      $change =Partners::where('id',$id)->first();
      if ($change) {
        $change->first_name                = $request->first_name;
        $change->last_name                 = $request->last_name;
        $change->partnership_category      = $request->partnership_category;
        $change->company_name              = $request->company_name;
        $change->about_company             = $request->about_company;
        $change->phone                     = $request->phone;
        $change->address                   = $request->address;
        $change->country                   = $request->country;
        $change->website                   = $request->website;
        $change->amount                    = $request->amount;
        $change->user_id                   = $request->user()->id;
        $change->event_id                  = $request->event_id;
        $change->save();
        return response()->json(['OK'=>'Values are Updated Successfully!!!','status'=>200]);
      }
      else {
        return response()->json(['message'=>'record does not exists to update','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied!','status'=>403]);
    }
  }
  public function delete(Request $request,$id)
  {
    $user  = User::where('id',$request->user()->id)->first();
    if ($user->hasRole(['admin','organiser','agency']) && $user->can('create')) {
      $remove =Partners::where('id',$id)->first();
      if ($remove) {
        $remove->delete();
        return response()->json(['Ok'=>'record is deleted','status'=>200]);
      }
      else {
        return response()->json(['message'=>'record does not exists to delete','status'=>404]);
      }
    }
    else {
      return response()->json(['message'=>'Permission Denied!','status'=>403]);
    }
  }
}
