<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BookUnit;
use App\Models\BooksInHand;

class BooksInHandController extends Controller
{
  
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = BooksInHand::orderBy('take_at','DESC')->paginate(10);
        return view('books-in-hand.index', compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id');
        
        //$units = BookUnit::pluck('book_id', 'id');
        $units = array();
        $data  = BookUnit::all();
        foreach ($data as $unit) {
          if (count($unit->hands) == 0) {
            $units[$unit->id] = $unit->barcode . ' > ' . $unit->book->autor . ' "' . $unit->book->name .'"';
          }          
        }
        
        return view('books-in-hand.create', compact('users', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'book_unit_id' => 'required',
            'user_id' => 'required',
            'take_at' => 'required'
        ]);

        BooksInHand::create($request->all());
        return redirect()->route('books-in-hand.index')
                        ->with('success','Запись создана.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item  = BooksInHand::find($id);
        return view('books-in-hand.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item  = BooksInHand::find($id);
        $users = User::pluck('name', 'id');
        $units = array();
        $data  = BookUnit::all();
        foreach ($data as $unit) {
          $units[$unit->id] = $unit->barcode . ' > ' . $unit->book->autor . ' "' . $unit->book->name .'"';         
        }
        return view('books-in-hand.edit', compact('item', 'units', 'users'));
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
        $this->validate($request, [
          'book_unit_id' => 'required',
          'user_id' => 'required',
          'take_at' => 'required'
        ]);

        BooksInHand::find($id)->update($request->all());
        return redirect()->route('books-in-hand.index')
                        ->with('success', 'Запись изменена.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BooksInHand::find($id)->delete();
        return redirect()->route('books-in-hand.index')
                        ->with('success', 'Запись удалена.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookreturn($id)
    {
      $item = BooksInHand::findOrFail($id);
      $item->return_at = \Carbon\Carbon::now();
      $item->save();
      
      return redirect()->route('books-in-hand.index')
          ->with('success', 'Книга возвращена.');
    }

}