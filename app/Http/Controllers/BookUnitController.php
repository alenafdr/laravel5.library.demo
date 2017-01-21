<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookUnit;

class BookUnitController extends Controller
{
  
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = BookUnit::orderBy('id','ASC')->paginate(10);
        return view('book-unit.index', compact('items'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::pluck('name', 'id');
        return view('book-unit.create', compact('books'));
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
            'book_id' => 'required',
            'barcode' => 'required'
        ]);

        BookUnit::create($request->all());
        return redirect()->route('book-unit.index')
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
        $item  = BookUnit::find($id);
        return view('book-unit.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = BookUnit::find($id);
        $books = Book::pluck('name', 'id');
        return view('book-unit.edit', compact('item', 'books'));
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
            'book_id' => 'required',
            'barcode' => 'required'
        ]);

        BookUnit::find($id)->update($request->all());
        return redirect()->route('book-unit.index')
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
        BookUnit::find($id)->delete();
        return redirect()->route('book-unit.index')
                        ->with('success', 'Запись удалена.');
    }

}