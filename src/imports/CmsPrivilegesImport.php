<?php 
namespace crocodicstudio\crudbooster\imports;

use Maatwebsite\Excel\Concerns\ToModel;
use crocodicstudio\crudbooster\models\CmsPrivilege;

class CmsPrivilegesImport implements ToModel {


    public function model(array $row)
    {
        
        return CmsPrivilege::firstOrCreate([
            'name'  => $row[1],
        ],[
            'is_superadmin' => $row[2],
            'theme_color'   => $row[3],
            'created_at'    => date('Y-m-d H:i:s')
        ]);
        
    }
}