<?php 
namespace crocodicstudio\crudbooster\imports;

use Maatwebsite\Excel\Concerns\ToModel;
use crocodicstudio\crudbooster\models\CmsPrintoutTemplate;

class CmsPrintoutTemplateImport implements ToModel {


    public function model(array $row)
    {
        
        return CmsPrintoutTemplate::firstOrCreate([
            'table_name'  => $row[1],
            'key'           => $row[4]
        ],[
            'file_name'    => $row[2],
            'file_type'     => $row[3],
            'model_path'    => $row[5],
            'overwrite_json'=> $row[6],
            'type'          => $row[7],
            'description'   => $row[8],
            'file'          => $row[9],
            'created_at'    => date('Y-m-d H:i:s')
        ]);
        
    }
}