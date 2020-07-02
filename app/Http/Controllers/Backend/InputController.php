<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\input;
use App\Http\Controllers\Controller;
use Validator;

class InputController extends Controller
{
    function index(){
        return view('backend.input.index');
    }
    function insert(Request $request)
    {
     if($request->ajax())
     {
      $rules = array(
       'category.*'  => 'required',
       'weight.*'  => 'required',
       'price.*'  => 'required',
      );
      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
       return response()->json([
        'error'  => $error->errors()->all()
       ]);
      }

      $category = $request->category;
      $weight = $request->weight;
      $price = $request->price;

      
      for($count = 0; $count < count($category_id); $count++)
      {
       $data = array(
        'category' => $category[$count],
        'weight'  => $weight[$count],
        'price'  => $price[$count],
       );
       $insert_data[] = $data; 
      }

      input::insert($insert_data);
      return response()->json([
       'success'  => 'Data Added successfully.'
      ]);
     }
    }
}
