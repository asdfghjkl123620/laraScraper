<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Link;
use App\Models\Item;
use App\Models\Website;

use App\Lib\Scraper;

use Illuminate\Http\Request;
use Goutte\Client;

class LinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = Link::orderBy('id', 'DESC')->paginate(10);
        $itemSch = Item::all();
        return view('dashboard.link.index')->withLinks($links)->withItem($itemSch);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $websites = Website::all();
        return view('dashboard.link.create')->withCategories($categories)->withWebsites($websites);

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
            'url' => 'required',
            'main_filter_selec'=>'required',
            'website_id' => 'required',
            'category_id'=>'required'
        ]);
        $link = new Link;
        $link->url = $request->input('url');
        $link->main_filter_selec = $request->input('main_filter_selec');
        $link->website_id = $request->input('website_id');
        $link->category_id = $request->input('category_id');
        $link->save();
        return redirect()->route('links.index');
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
        $categories = Category::all();
        $websites = Website::all();
        return view('dashboard.link.edit')->withLink(Link::find($id))->withCategories($categories)->withWebsites($websites);
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
            'url' => 'required',
            'main_filter_selec'=>'required',
            'website_id' => 'required',
            'category_id'=>'required'
        ]);
        $link = Link::find($id);
        $link->url = $request->input('url');
        $link->main_filter_selec = $request->input('main_filter_selec');
        $link->website_id = $request->input('website_id');
        $link->category_id = $request->input('category_id');
        $link->save();
        return redirect()->route('links.index');
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

    /**
     * set item
     *
     * @param   $request
     * @return  json
     */
    public function setItem(Request $request)
    {
        if(!$request->item_id && !$request->link_id)
            return;

        $link = Link::find($request->link_id);
        $link -> item_id = $request->item_id;
        $link->save();
        return response()->json(['msg'=>'Link updated!']);
    }

    /**
     * scrap link
     *
     * @param   $request
     * @return  json
     */
    public function scrape(Request $request) 
    {
        if(!$request->link_id)
            return;

        $link = Link::find($request->link_id);

        if(empty($link->main_filter_selec) &&
           (empty($link->item_id) || $link->item_id == 0)) {
               return;
        }

        $scraper = new Scraper(new Client());
        $scraper->handle($link);

        if($scraper->status == 1) {
            return response()->json(['status'=>1, 'msg'=>'完成爬蟲']);
        } else {
            return response()->json(['status'=>2, $scraper->status]);
        }
    }
}
