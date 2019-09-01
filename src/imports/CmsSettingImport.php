<?php 
namespace crocodicstudio\crudbooster\imports;

use Maatwebsite\Excel\Concerns\ToModel;
use crocodicstudio\crudbooster\models\CmsSetting;
use crocodicstudio\crudbooster\models\CmsPrivilege;

class CmsSettingImport implements ToModel {


    public function model(array $row)
    {
        
        return CmsSetting::firstOrCreate([
            'name'  => $row[1],
        ],[
            'content'=> $row[2],
            'content_input_type'=> $row[3],
            'dataenum'=> $row[4],
            'helper'=> $row[5],
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
            'group_setting'=>$row[8],
            'label'     => $row[9]
        ]);
        
    }
}