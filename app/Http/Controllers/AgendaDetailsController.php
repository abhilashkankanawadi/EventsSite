<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event_DaysInfo;

class AgendaDetailsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function show($id)
  {
    $agendadetails  = Event_DaysInfo::where('id',$id)->get();
    return view('Agenda',['agendadetails'=>$agendadetails]);
  }
}
