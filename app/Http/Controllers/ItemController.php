<?php

namespace App\Http\Controllers;

use App\Models\Item;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemSch = Item::orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.item.index')->withItem($itemSch);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.item.create');
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
            'title' => 'required',
            'css_exp'=>'required',
            'full_content_selec' => "required"
        ]);
        $itemSch = new Item;
        $itemSch->title = $request->input('title');

        if($request->input('is_full_url') != null) {
            $itemSch->is_full_url = 1;
        } else {
            $itemSch->is_full_url = 0;
        }

        $itemSch->css_exp = $request->input('css_exp');
        $itemSch->full_content_selec = $request->input('full_content_selec');

        $itemSch->save();
        return redirect()->route('item.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dashboard.item.edit')->withItem(Item::find($id));
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
            'title' => 'required',
            'css_exp' => 'required',
            'full_content_selec' => 'required',
        ]);

        $itemSch = Item::find($id);

        $itemSch->title = $request->input('title');

        if($request->input('is_full_url') != null) {
            $itemSch->is_full_url = 1;
        } else {
            $itemSch->is_full_url = 0;
        }

        $itemSch->css_exp = $request->input('css_exp');
        $itemSch->full_content_selec = $request->input('full_content_selec');

        $itemSch->save();
        return redirect()->route('item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
