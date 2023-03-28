<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Revenue;
use App\Models\Category;
use App\Http\Requests\RevenueRequest;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $revenues=Revenue::paginate(5);
        return view('backend/pages/revenues/index' , compact('revenues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::get();
        return view('backend/pages/revenues/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RevenueRequest $request)
    {
      $validated=$request->validated();
      Revenue::create($validated);
        return redirect()->route('revenue.index')->with('success','Revenue created successfully.');
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

        $revenues=Revenue::find($id);
        $categories=Category::get();
        $formattedDate = new DateTime($revenues->date);
        $formattedDate = $formattedDate->format('Y-m-d');
        return view('backend/pages/revenues/edit', compact('revenues','formattedDate','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RevenueRequest $request, $id)
    {
        $revenues=Revenue::find($id);
        $validated=$request->validated();
        $revenues->update($validated);
        return redirect()->route('revenue.index')->with('success','Revenue updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Revenue::find($id)->delete();
        return redirect()->route('revenue.index')->with('success','Revenue deleted successfully');
    }
}
