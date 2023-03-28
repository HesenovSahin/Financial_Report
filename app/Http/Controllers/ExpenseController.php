<?php

namespace App\Http\Controllers;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Category;
use App\Http\Requests\ExpenseRequest;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses=Expense::paginate(5);
        return view('backend/pages/expenses/index' , compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::get();
        return view('backend/pages/expenses/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        $validated=$request->validated();
        Expense::create($validated);
        return redirect()->route('expense.index')->with('success','Expense created successfully.');
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

        $expenses=Expense::find($id);
        $categories = Category::get();
        $formattedDate = new DateTime($expenses->date);
        $formattedDate = $formattedDate->format('Y-m-d');
        return view('backend/pages/expenses/edit', compact('expenses','formattedDate','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseRequest $request, $id)
    {
        $expenses=Expense::find($id);
        $validated=$request->validated();
        $expenses->update($validated);
        return redirect()->route('expense.index')->with('success','Expense updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expense::find($id)->delete();
        return redirect()->route('expense.index')->with('success','Expense deleted successfully');
    }
}
