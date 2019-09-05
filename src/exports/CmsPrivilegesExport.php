<?php 
namespace crocodicstudio\crudbooster\exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use crocodicstudio\crudbooster\models\CmsPrivilege;


class CmsPrivilegesExport implements FromQuery {
    use Exportable;

    public function query()
    {
        
        return CmsPrivilege::query();
    }
}