<?php 
namespace crocodicstudio\crudbooster\imports;

use Maatwebsite\Excel\Concerns\ToModel;
use crocodicstudio\crudbooster\models\CmsModul;
use crocodicstudio\crudbooster\models\CmsPrivilege;
use crocodicstudio\crudbooster\models\CmsPrivilegesRole;


class CmsPrivilegesRolesImport implements ToModel {


    public function model(array $row)
    {
        // dd($row);
        $privilege = CmsPrivilege::firstOrCreate(['name'=>$row[6]],['is_superadmin'=>0,'theme_color'=>'skin-red']);
        $arrModul = explode("<>",$row[7]);
        // dd($arrModul);
        $modul = CmsModul::firstOrCreate(["path"=>$arrModul[0],"controller"=>$arrModul[1]],['is_protected'=>0,'is_active'=>0]);
        return CmsPrivilegesRole::firstOrCreate([
            'id_cms_privileges' => $privilege->id,
            'id_cms_moduls'     => $modul->id,
        ],[
            'is_visible'        => $row[1],
            'is_create'         => $row[2],
            'is_read'           => $row[3],
            'is_edit'           => $row[4],
            'is_delete'         => $row[5],
            'created_at'        => date('Y-m-d H:i:s')
        ]);
        
    }
}