<?php 
namespace crocodicstudio\crudbooster\imports;

use Maatwebsite\Excel\Concerns\ToModel;
use crocodicstudio\crudbooster\models\CmsMenu;
use crocodicstudio\crudbooster\models\CmsPrivilege;

class CmsMenuImport implements ToModel {


    public function model(array $row)
    {
        
        $parent = null;
        $explodeParent = explode('<>',$row[6]);
        
        if(count($explodeParent) == 2){
            $parent = CmsMenu::where('name',$explodeParent[0])->where('path',$explodeParent[1])->first();
        }
        
        if($row[9] != null){
            $isExists = CmsMenu::where('name',$row[1])->path($row[3])->first();
            $cmsPrivileges = CmsPrivilege::firstOrCreate(['name'=>$row[9]],['is_superadmin'=>0,'theme_color'=>'skin-red']);
            return CmsMenu::firstOrCreate([
                'name'           => $row[1],
                'type'           => $row[2],
                'path'           => $row[3],
            ],[
                'color'           => $row[4],
                'icon'           => $row[5],
                'parent_id'      => $parent?$parent->id:null,
                'is_active'      => $row[7],
                'is_dashboard'   => $row[8],
                'id_cms_privileges'  => $cmsPrivileges->id,
                'sorting'        => $row[10],
                'created_at'     => date('Y-m-d H:i:s')
             ]);
        }
        
    }
}