<?php 
namespace crocodicstudio\crudbooster\exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use crocodicstudio\crudbooster\models\CmsMenu;
use crocodicstudio\crudbooster\models\CmsPrivilege;

class CmsMenuExport implements FromQuery,WithMapping {
    use Exportable;

    public function query()
    {
        
        return CmsMenu::query();
    }

    public function map($row): array {
        $parentString = "";
        if($row->parent_id){
            $parent = CmsMenu::find($row->parent_id);
            $parentString = "{$parent->name}<>{$parent->path}";
        }
        $cmsPrivileges = CmsPrivilege::find($row->id_cms_privileges);

        return [
            $row->id,
            $row->name,
            $row->type,
            $row->path,
            $row->color,
            $row->icon,
            $parentString,
            $row->is_active,
            $row->is_dashboard,
            $cmsPrivileges->name,
            $row->sorting,
            $row->created_at,
            $row->updated_at
        ];
    }
}