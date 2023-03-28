<?php

namespace App\Exports;


use App\Models\Revenue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class RevenuesExport implements FromCollection, WithHeadings,ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $fromDate;
    protected $toDate;
    protected $revenues;
    protected $totalRevenues;


    public function __construct($fromDate, $toDate, $revenues,$totalRevenues)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->revenues = $revenues;
        $this->totalRevenues = $totalRevenues;

    }

    public function collection()
    {
        return $this->revenues;
    }

    public function headings(): array
    {
        return [
            'Date',
            'Source',
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

                $event->sheet->setCellValue('A'.($lastRow+2), 'Total Revenues:');
                $event->sheet->setCellValue('D'.($lastRow+2), $this->totalRevenues);
            },
        ];
    }
}
