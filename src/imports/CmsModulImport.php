<?php 
namespace crocodicstudio\crudbooster\imports;

use Maatwebsite\Excel\Concerns\ToModel;
use crocodicstudio\crudbooster\models\CmsModul;

class CmsModulImport implements ToModel {


    public function model(array $row)
    {
        
        return CmsModul::firstOrCreate([
            'path'      => $row[3],
            'controller'=> $row[5],
        ],[
            'name'      => $row[1],
            'table_name'=> $row[4],
            'icon'      => $row[2],
            'is_protected'=> $row[6],
            'is_active'=> $row[7],
            'created_at'=> date('Y-m-d H:i:s'),
        ]);
        
    }
}