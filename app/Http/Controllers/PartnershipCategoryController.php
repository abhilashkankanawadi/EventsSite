<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Partners; 
use App\PartnershipCategory;
use App\User;
use Validator;

class PartnershipCategoryController extends Controller
{
    public function index()
    {
      return "hi";
    }

    public function show($id) 
    {
      $partnerCategory = PartnershipCategory::where('event_id',$id)->get();
      return view('Partners',['partnerCategory'=>$partnerCategory,'id'=>$id]);
    }
}
