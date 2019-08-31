<?php 
namespace crocodicstudio\crudbooster\exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use crocodicstudio\crudbooster\models\CmsModul;
use crocodicstudio\crudbooster\models\CmsPrivilege;
use crocodicstudio\crudbooster\models\CmsPrivilegesRole;

class CmsPrivilegesRolesExport implements FromQuery, WithMapping {
    use Exportable;

    public function query()
    {
        
        return CmsPrivilegesRole::query();
    }

    public function map($row): array {
        $cmsPrivilege   = CmsPrivilege::find($row->id_cms_privileges);
        $cmsModul       = CmsModul::find($row->id_cms_moduls);
        return [
            $row->id,
            $row->is_visible,
            $row->is_create,
            $row->is_read,
            $row->is_edit,
            $row->is_delete,
            "{$cmsPrivilege->name}",
            "{$cmsModul->path}<>{$cmsModul->controller}"
        ];
    }
}