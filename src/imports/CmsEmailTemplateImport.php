<?php 
namespace crocodicstudio\crudbooster\imports;

use Maatwebsite\Excel\Concerns\ToModel;
use crocodicstudio\crudbooster\models\CmsSyncTable;
use crocodicstudio\crudbooster\models\CmsEmailTemplate;

class CmsEmailTemplateImport implements ToModel {


    public function model(array $row)
    {
        
        return CmsEmailTemplate::firstOrCreate([
            'slug'  => $row[2],
        ],[
            'name'  => $row[1],
            'subject'=> $row[3],
            'content'=> $row[4],
            'description'=> $row[5],
            'from_name'=> $row[6],
            'from_email'=> $row[7],
            'cc_email'  => $row[8],
            'created_at'=> date('Y-m-d H:i:s')
        ]);
        
    }
}