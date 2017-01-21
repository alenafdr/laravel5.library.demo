<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

use App\Models\User;

class UserController extends \App\Http\Controllers\Controller
{
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
	{
    try {
      
      $statusCode = 200;
      $response = [
        'success' => true,
        'data'  => []
      ];

      $items = User::all();

      foreach($items as $item) {
        
        $response['data'][] = [
          'id'          => (int) $item->id,
          'name'        => $item->name,
          'email'       => $item->email
        ];
      }
    
    } catch (\Exception $e){
      $statusCode = 500;
      $response = [
        'success' => false,
        'error'  => [
          'code' => $e->getCode(),
          'message' => $e->getMessage()
        ]
      ];
    } finally {
      return response()->json($response, $statusCode);
    }
	}
  
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) 
	{
    try {
      $statusCode = 200;
      $response = [
        'success' => true,
        'data'  => []
      ];
      
      $item = User::findOrFail($id);
      $statusCode = 200;
      $response['data'] = [
        'id'          => (int) $item->id,
        'name'        => $item->name,
        'email'       => $item->email
      ];
      
    } catch (\Exception $e) {
      $statusCode = 400;
      $response = [
        'success' => false,
        'error'  => [
          'code' => $e->getCode(),
          'message' => $e->getMessage()
        ]
      ];
    } finally {
      return response()->json($response, $statusCode);
    }
	}
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
     
  public function store(Request $request)
  {
    try {
      $statusCode = 200;
      $response = ['success' => true];

      $this->validate($request, [
        'name' => 'required|string',
        'email' => 'required|string'
      ]);

      User::create($request->all());
      
    } catch (\Exception $e) {
      $statusCode = 400;
      $response = [
        'success' => false,
        'error'  => [
          'code' => $e->getCode(),
          'message' => $e->getMessage()
        ]
      ];
    } finally {
      return response()->json($response, $statusCode);
    }
  }
  
  /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function update(Request $request, $id)
  {
    try {
      $statusCode = 200;
      $response = ['success' => true];

      $this->validate($request, [
        'name' => 'string',
        'email' => 'string'
      ]);

      User::findOrFail($id)->update($request->all());
      
    } catch (\Exception $e) {
      $statusCode = 400;
      $response = [
        'success' => false,
        'error'  => [
          'code' => $e->getCode(),
          'message' => $e->getMessage()
        ]
      ];
    } finally {
      return response()->json($response, $statusCode);
    }
  }
    
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    try {
      $statusCode = 200;
      $response = ['success' => true];
      User::findOrFail($id)->delete();
    } catch (\Exception $e) {
      $statusCode = 400;
      $response = [
        'success' => false,
        'error'  => [
          'code' => $e->getCode(),
          'message' => $e->getMessage()
        ]
      ];
    } finally {
      return response()->json($response, $statusCode);
    }
  }
  
}