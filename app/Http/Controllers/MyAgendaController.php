<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyAgenda;
use Validator;
use App\User;

class MyAgendaController extends Controller
{
    public function index()
    {
      $speakeragenda = MyAgenda::all();
      return view('Agenda',['speakeragenda'=>$speakeragenda]);
      // $mynote = new MyAgenda;
      // $mynote->event__days_infos_id = $request->task_id;
      // $mynote->user_id = $request->user()->id;
      // $mynote->save();
      // return response()->JSON($mynote);
    }
}
