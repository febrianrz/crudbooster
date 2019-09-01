<?php 
namespace crocodicstudio\crudbooster\exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use crocodicstudio\crudbooster\models\CmsSyncTable;


class CmsSyncTableExport implements FromQuery {
    use Exportable;

    public function query()
    {
        
        return CmsSyncTable::query();
    }
}