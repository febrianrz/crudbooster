<?php 
namespace crocodicstudio\crudbooster\exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use crocodicstudio\crudbooster\models\CmsMenu;
use crocodicstudio\crudbooster\models\CmsEmailTemplate;

class CmsEmailTemplateExport implements FromQuery {
    use Exportable;

    public function query()
    {
        
        return CmsEmailTemplate::query();
    }
}