<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InStockLevel;
use Illuminate\Http\Request;

class InStockLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.in_stock_level.index');
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
        InStockLevel::create($request->all());
        toastr()->success('In-Stock Level is Created Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InStockLevel  $inStockLevel
     * @return \Illuminate\Http\Response
     */
    public function show(InStockLevel $inStockLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InStockLevel  $inStockLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(InStockLevel $inStockLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InStockLevel  $inStockLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $inStockLevel = InStockLevel::find($id);
        $inStockLevel->update($request->all());
        toastr()->success('In-Stock Level Informations Updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InStockLevel  $inStockLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inStockLevel = InStockLevel::find($id);
        $inStockLevel->delete();
        toastr()->success('InStock Level Deleted Successfully');
        return redirect()->back();
    }
}
