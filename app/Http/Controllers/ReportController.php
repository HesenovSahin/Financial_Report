<?php

namespace App\Http\Controllers;
use DateTime;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Revenue;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExpensesExport;
use App\Exports\RevenuesExport;
use Barryvdh\DomPDF\Facade;
class ReportController extends Controller
{
    public function index(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $expenses = Expense::whereBetween('date', [$fromDate, $toDate])->get();
        $totalExpenses = $expenses->sum('nominal');

        $revenues = Revenue::whereBetween('date', [$fromDate, $toDate])->get();
        $totalRevenues = $revenues->sum('nominal');

        return view('backend.pages.reports.index', compact('expenses', 'totalExpenses', 'revenues', 'totalRevenues'));
    }

    public function exportExpenses(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        $expenses = Expense::select('date', 'explanation', 'nominal', 'categories.title')
            ->leftjoin('categories', 'categories.id', '=', 'expenses.cat_id')
            ->whereBetween('date', [$fromDate, $toDate])
            ->get();
        $totalExpenses = $expenses->sum('nominal');
        return Excel::download(new ExpensesExport($fromDate, $toDate, $expenses,$totalExpenses), 'expenses.xlsx');
    }


    public function exportRevenues(Request $request)
    {

        $timestamp = time();
        $fileName = "revenues_$timestamp.xlsx";
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $revenues= Revenue::select('date','sources', 'explanation', 'nominal', 'categories.title')
            ->rightjoin('categories', 'categories.id', '=', 'revenues.cat_id')
            ->whereBetween('date', [$fromDate, $toDate])
            ->get();

        $totalRevenues = $revenues->sum('nominal');

        return Excel::download(new RevenuesExport($fromDate, $toDate, $revenues,$totalRevenues), $fileName);
    }

    public function viewExpensesPdf(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // Get expenses based on the date range
        $expenses = Expense::whereBetween('date', [$fromDate, $toDate])->get();

        // Calculate total expenses
        $totalExpenses = $expenses->sum('nominal');

        // Generate PDF view
        $pdf = Facade\Pdf::loadView('backend.pages.reports.expenses-pdf', compact('expenses', 'totalExpenses', 'fromDate', 'toDate'));

        // Return the view PDF in new tab
        return $pdf->stream('expenses-report.pdf');
    }

    public function downloadExpensesPdf(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // Get expenses based on the date range
        $expenses = Expense::whereBetween('date', [$fromDate, $toDate])->get();

        // Calculate total expenses
        $totalExpenses = $expenses->sum('nominal');

        // Generate PDF view
        $pdf = Facade\Pdf::loadView('backend.pages.reports.expenses-pdf', compact('expenses', 'totalExpenses', 'fromDate', 'toDate'));

        // Return the PDF as download file
        return $pdf->download('expenses-report.pdf');
    }

    public function viewRevenuesPdf(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // Get revenues based on the date range
        $revenues = Revenue::whereBetween('date', [$fromDate, $toDate])->get();

        // Calculate total revenues
        $totalRevenues = $revenues->sum('nominal');

        // Generate PDF view
        $pdf = Facade\Pdf::loadView('backend.pages.reports.revenues-pdf', compact('revenues', 'totalRevenues', 'fromDate', 'toDate'));

        // Return the view PDF in new tab
        return $pdf->stream('revenues-report.pdf');
    }

    public function downloadRevenuesPdf(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // Get revenues based on the date range
        $revenues = Revenue::whereBetween('date', [$fromDate, $toDate])->get();

        // Calculate total revenues
        $totalRevenues = $revenues->sum('nominal');

        // Generate PDF view
        $pdf = Facade\Pdf::loadView('backend.pages.reports.revenues-pdf', compact('revenues', 'totalRevenues', 'fromDate', 'toDate'));

        // Return the PDF as download file
        return $pdf->download('revenues-report.pdf');
    }
}
