<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\MedicalRecord;
use App\Models\MedicalRecordMedicine;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PatientExport implements FromView, WithEvents
{
    public $totalValue;
    public function __construct($date)
    {
        $this->date = $date;
    }

    public function view(): View
    {
        $date = $this->date;


        $medical_records = MedicalRecord::whereYear('medical_records.created_at', Carbon::parse($this->date)->year)
            ->whereMonth('medical_records.created_at', Carbon::parse($this->date)->month)
            ->groupByRaw('DATE_FORMAT(medical_records.created_at, "%d/%m/%Y")')
            ->get();

        return view('pages.medicalRecord.excel', compact('medical_records', 'date'));
    }

    public function registerEvents(): array
    {
        $start = 6;
        $this->totalValue = MedicalRecordMedicine::whereYear('created_at', Carbon::parse($this->date)->year)
            ->whereMonth('created_at', Carbon::parse($this->date)->month)
            ->groupByRaw('DATE_FORMAT(created_at, "%d/%m/%Y")')
            ->count();
        $cellRange      = 'A' . $start . ':L' . $start + $this->totalValue;
        return [
            AfterSheet::class => function (AfterSheet $event) use ($cellRange) {
                $event->sheet->getDelegate()->getStyle('A1:W1')->getFont('Times New Roman', 16, true, false)->setBold(true)->setSize(16);
                $event->sheet->getDelegate()->getStyle('A2:W2')->getFont('Times New Roman', 16, true, false)->setBold(true)->setSize(16);
                $event->sheet->getDelegate()->getStyle('A3:W3')->getFont('Times New Roman', 12, true, false)->setBold(true)->setSize(12);
                $event->sheet->getDelegate()->getStyle('A4:L5')->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => '000000'],
                        ],
                        'vertical' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    ],
                ]);
                $event->sheet->getStyle($cellRange)->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => '000000'],
                        ],
                        'vertical' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ])->getAlignment()->setWrapText(true);
            },
        ];
    }
}
