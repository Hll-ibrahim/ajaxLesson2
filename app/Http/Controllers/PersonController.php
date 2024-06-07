<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PersonController extends Controller
{
    public function post(Request $request){
        $request->validate([
            'name'=>'required',
            'age'=>'required',
            'weight'=>'required',
            'height'=>'required',
        ],[
            'name.required'=>'İsim Alanı Zorunludur',
        ]);

        $person = Person::create($request->all());

        return response()->json(['success'=>true,'person'=>$person]);

    }

    public function fetch(){
        $people = Person::get();
        return DataTables::of($people)
            ->addColumn('update',function($person){
                return '<a class="btn btn-primary" onclick="update('.$person->id.')">güncelle</a>';
            })
            ->rawColumns(['update'])
            ->make();
    }
}
