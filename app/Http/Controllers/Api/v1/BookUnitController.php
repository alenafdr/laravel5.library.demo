<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

use App\Models\Book;
use App\Models\BookUnit;

class BookUnitController extends \App\Http\Controllers\Controller
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

      $items = BookUnit::all();

      foreach($items as $item) {
        
        $book = $item->book;
        
        $response['data'][] = [
          'id'          => (int) $item->id,
          'book_id'     => $item->book_id,
          'barcode'     => $item->barcode,
          'book'        => [
            'id'          => (int) $book->id,
            'name'        => $book->name,
            'autor'       => $book->autor,
            'description' => $book->description,
          ]
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
      
      $item = BookUnit::findOrFail($id);
      $statusCode = 200;
      
      $book = $item->book;
      
      $response['data'] = [
        'id'          => (int) $item->id,
        'book_id'     => $item->book_id,
        'barcode'     => $item->barcode,
        'book'        => [
          'id'          => (int) $book->id,
          'name'        => $book->name,
          'autor'       => $book->autor,
          'description' => $book->description,
        ]
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
        'barcode' => 'required|string',
        'book_id' => 'required|integer'
      ]);

      $response['data'] = BookUnit::create($request->all())->id;
      
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
      $response = ['success' => true, 'data'=>$id];

      $this->validate($request, [
        'barcode' => 'string',
        'book_id' => 'integer'
      ]);

      BookUnit::findOrFail($id)->update($request->all());
      
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
      $response = ['success' => true, 'data'=>$id];
      BookUnit::findOrFail($id)->delete();
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