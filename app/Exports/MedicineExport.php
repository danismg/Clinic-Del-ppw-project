<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Medicine;
use App\Models\MedicineInOut;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class MedicineExport implements FromView, WithEvents
{
    public function __construct(string $date)
    {
        $this->date = $date;
    }
    public function view(): View
    {
        $medicines = Medicine::all();
        $month = Carbon::parse($this->date)->month;
        $year = Carbon::parse($this->date)->year;
        $medicines = MedicineInOut::join('medicines', 'medicines.id', '=', 'medicine_in_outs.medicine_id')
            ->whereYear('medicine_in_outs.created_at', $year)
            ->whereMonth('medicine_in_outs.created_at', $month)
            ->selectRaw('medicines.id, medicines.name, SUM(medicine_in_outs.quantity_in) as quantity_in, SUM(medicine_in_outs.quantity_out) as quantity_out, quantity_remaining')
            ->groupBy('medicine_id')
            ->orderBy('medicine_id')
            ->get();
        $date = $this->date;
        return view('pages.medicine.excel', compact('medicines', 'date'));
    }

    public function registerEvents(): array
    {
        $start = 3;
        $this->totalValue = MedicineInOut::whereYear('created_at', Carbon::parse($this->date)->year)
            ->whereMonth('created_at', Carbon::parse($this->date)->month)
            ->distinct('medicine_id')
            ->count();
        $cellRange      = 'A' . $start . ':F' . $start + $this->totalValue;
        return [
            AfterSheet::class => function (AfterSheet $event) use ($cellRange) {
                $event->sheet->getDelegate()->getStyle('A1:W1')->getFont('Times New Roman', 16, true, false)->setBold(true)->setSize(16);
                $event->sheet->getDelegate()->getStyle('A2:W2')->getFont('Times New Roman', 16, true, false)->setBold(true)->setSize(16);
                $event->sheet->getDelegate()->getStyle('A3:F3')->applyFromArray([
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
            }
        ];
    }
}
