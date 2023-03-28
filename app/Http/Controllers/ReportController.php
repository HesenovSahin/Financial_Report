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

//    public function expenseViewPDF(Request $request)
//    {
//        $fromDate = $request->input('from_date');
//        $toDate = $request->input('to_date');
//
//        $expenses = Expense::with('category')->whereBetween('date', [$fromDate, $toDate])->get();
//        $totalExpenses = Expense::whereBetween('date', [$fromDate, $toDate])->sum('nominal');
//
//        $data = [
//            'expenses' => $expenses,
//            'totalExpenses' => $totalExpenses,
//        ];
//        $pdf = PDF::loadView('backend.reports.pdf', $data);
//        return $pdf->stream();
//    }
//
//    public function expenseDownloadPDF(Request $request)
//    {
//        $fromDate = $request->input('from_date');
//        $toDate = $request->input('to_date');
//
//        $expenses = Expense::with('category')->whereBetween('date', [$fromDate, $toDate])->get();
//        $totalExpenses = Expense::whereBetween('date', [$fromDate, $toDate])->sum('nominal');
//
//        $data = [
//            'expenses' => $expenses,
//            'totalExpenses' => $totalExpenses,
//        ];
//
//        $pdf = PDF::loadView('backend.reports.pdf', $data);
//        return $pdf->download('report.pdf');
//    }
//
//    public function revenuesViewPDF(Request $request)
//    {
//        $fromDate = $request->input('from_date');
//        $toDate = $request->input('to_date');
//
//        $revenues = Revenue::with('category')->whereBetween('date', [$fromDate, $toDate])->get();
//        $totalRevenues = Revenue::whereBetween('date', [$fromDate, $toDate])->sum('nominal');
//
//        $data = [
//            'revenues' => $revenues,
//            'totalRevenues' => $totalRevenues,
//        ];
//        $pdf = PDF::loadView('backend.reports.pdf', $data);
//        return $pdf->stream();
//    }
//
//
//    public function revenuesDownloadPDF(Request $request)
//    {
//        $fromDate = $request->input('from_date');
//        $toDate = $request->input('to_date');
//
//        $revenues = Revenue::with('category')->whereBetween('date', [$fromDate, $toDate])->get();
//        $totalRevenues = Revenue::whereBetween('date', [$fromDate, $toDate])->sum('nominal');
//
//        $data = [
//            'revenues' => $revenues,
//            'totalRevenues' => $totalRevenues,
//        ];
//
//        $pdf = PDF::loadView('backend.reports.pdf', $data);
//        return $pdf->download('report.pdf');
//    }
}
