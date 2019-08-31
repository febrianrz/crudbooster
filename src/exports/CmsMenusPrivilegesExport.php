<?php 
namespace crocodicstudio\crudbooster\exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use crocodicstudio\crudbooster\models\CmsMenu;
use crocodicstudio\crudbooster\models\CmsPrivilege;
use crocodicstudio\crudbooster\models\CmsMenusPrivilege;

class CmsMenusPrivilegesExport implements FromQuery, WithMapping {
    use Exportable;

    public function query()
    {
        
        return CmsMenusPrivilege::query();
    }

    public function map($row): array {
        $cmsMenu = CmsMenu::find($row->id_cms_menu);
        $cmsPrivileges = CmsPrivilege::find($row->id_cms_privileges);
        
        if($row->id){
            return [
                $row->id,
                "{$cmsMenu->name}<>{$cmsMenu->path}",
                "{$cmsPrivileges->nama}"
            ];
        }
        
    }

}