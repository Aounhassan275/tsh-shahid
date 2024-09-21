<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FrontTicker;
use Illuminate\Http\Request;

class FrontTickerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.front_ticker.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        FrontTicker::create($request->all());
        toastr()->success('Ticker Message is Created Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FrontTicker  $frontTicker
     * @return \Illuminate\Http\Response
     */
    public function show(FrontTicker $frontTicker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FrontTicker  $frontTicker
     * @return \Illuminate\Http\Response
     */
    public function edit(FrontTicker $frontTicker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FrontTicker  $frontTicker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FrontTicker $frontTicker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FrontTicker  $frontTicker
     * @return \Illuminate\Http\Response
     */
    public function destroy(FrontTicker $ticker)
    {
        $ticker->delete();
        toastr()->success('Ticker Message Informations Deleted successfully');
        return redirect()->back();
    }
}
