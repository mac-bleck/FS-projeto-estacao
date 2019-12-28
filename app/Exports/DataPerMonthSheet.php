<?php

namespace App\Exports;

use App\Data;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DataPerMonthSheet implements FromQuery, WithTitle, WithMapping, WithHeadings, WithColumnFormatting
{

    use Exportable;

    private $sensors_id;
    private $date;

    public function __construct(int $sensors_id, string $date)
    {
        $this->sensors_id = $sensors_id;
        $this->date = $date;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return Data::query()->where('sensors_id', $this->sensors_id)
                            ->where([['created_at', 'like', $this->date.'%']]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->date;
    }

    /**
    * @var Invoice $invoice
    */
    public function map($data): array
    {
        return [
            $data->id,
            $data->value,
            Date::dateTimeToExcel($data->created_at),
        ];
    }

    public function headings(): array
    {
        return [
            'Id',
            'Valor',
            'Data'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_DATE_DATETIME
        ];
    }
}