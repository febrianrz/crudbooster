<?php 
namespace crocodicstudio\crudbooster\imports;

use Maatwebsite\Excel\Concerns\ToModel;
use crocodicstudio\crudbooster\models\CmsSyncTable;

class CmsSyncTableImport implements ToModel {


    public function model(array $row)
    {
        
        return CmsSyncTable::firstOrCreate([
            'table_name'  => $row[1],
            'column_key'    => $row[2],
        ],[
            'approach'      => $row[3],
            'is_active'     => $row[4],
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
            'export_path'   => $row[8],
            'import_path'   => $row[9]
        ]);
        
    }
}