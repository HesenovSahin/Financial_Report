<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ExpensesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $fromDate;
    protected $toDate;
    protected $expenses;
    protected $totalExpenses;

    public function __construct($fromDate, $toDate, $expenses, $totalExpenses)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->expenses = $expenses;
        $this->totalExpenses = $totalExpenses;
    }

    public function collection()
    {
        return $this->expenses;
    }

    public function headings(): array
    {
        return [
            'Date',
            'Explanation',
            'Amount',
            'Category',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $lastRow = $event->sheet->getHighestRow();

                $event->sheet->getStyle('A1:D1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ]
                ]);

                $event->sheet->getStyle('A'.$lastRow.':D'.$lastRow)->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ]
                ]);

                $event->sheet->setCellValue('A'.($lastRow+2), 'Total Expenses:');
                $event->sheet->setCellValue('D'.($lastRow+2), $this->totalExpenses);
            },
        ];
    }
}





