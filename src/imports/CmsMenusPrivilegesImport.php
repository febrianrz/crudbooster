<?php 
namespace crocodicstudio\crudbooster\imports;

use Maatwebsite\Excel\Concerns\ToModel;
use crocodicstudio\crudbooster\models\CmsMenu;
use crocodicstudio\crudbooster\models\CmsModul;
use crocodicstudio\crudbooster\models\CmsPrivilege;
use crocodicstudio\crudbooster\models\CmsMenusPrivilege;
use crocodicstudio\crudbooster\models\CmsPrivilegesRole;


class CmsMenusPrivilegesImport implements ToModel {


    public function model(array $row)
    {
        $arrMenu = explode("<>",$row[1]);
        if(count($arrMenu) == 2){
            dd($arrMenu);
            $menu = CmsMenu::firstOrCreate(['name'=>$arrMenu[0],'path'=>$arrMenu[1]]);
            $privilege = CmsPrivilege::firstOrCreate(['name'=>$row[2]],['is_superadmin'=>0,'theme_color'=>'skin-red']);
            if($menu){
                return CmsMenusPrivilege::firstOrCreate([
                    'id_cms_menus'   => $menus->id,
                    'id_cms_privileges'=> $privilege->id,
                   ]);
            }
        }
        
       
    }
}