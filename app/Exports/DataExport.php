<?php

namespace App\Exports;

use App\Data;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DataExport implements WithMultipleSheets
{

    private $sensors_id;

    public function __construct(int $sensors_id)
    {
        $this->sensors_id = $sensors_id;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $dates = Data::select(\DB::raw('DATE_FORMAT(created_at, "%Y-%m") as date'))
                       ->where('sensors_id', $this->sensors_id)
                       ->groupby('date')
                       ->distinct()
                       ->get();
                       
        $sheets = [];

        for ($i = 0; $i <= count($dates) - 1; $i++) {
            $sheets[] = new DataPerMonthSheet($this->sensors_id, $dates[$i]->date);
        }

        return $sheets;
    }

   
}
