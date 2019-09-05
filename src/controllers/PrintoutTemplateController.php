<?php namespace crocodicstudio\crudbooster\controllers;



use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\PDF;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use crocodicstudio\crudbooster\controllers\CBController;

class PrintoutTemplateController extends CBController
{
    public function cbInit()
    {
        $this->table = 'cms_printout_templates';
        $this->primary_key = 'id';
        $this->title_field = "key";
        $this->order_by = "id,desc";
        $this->button_bulk_action = true;
        $this->button_export = false;
        $this->button_import = false;
        $this->button_add = true;
        $this->button_edit = true;
        $this->button_delete = true;
        $this->global_privilege = false;

        $this->col = [];
        $this->col[] = ["label" => "Key", "name" => "key"];
        $this->col[] = ["label" => "Tipe", "name" => "type"];
        $this->col[] = ["label" => "Description", "name" => "description"];
        $this->col[] = ["label" => "File", "name" => "file","download"=>true];

        $this->form = [];
        $tables = CRUDBooster::listTables();
        $tables_list = [];
        foreach ($tables as $tab) {
            foreach ($tab as $key => $value) {
                $label = $value;

                if (substr($value, 0, 4) == 'cms_') {
                    continue;
                }

                $tables_list[] = $value."|".$label;
            }
        }
        foreach ($tables as $tab) {
            foreach ($tab as $key => $value) {
                $label = "[Default] ".$value;
                if (substr($value, 0, 4) == 'cms_') {
                    $tables_list[] = $value."|".$label;
                }
            }
        }

        $this->form[] = ["label" => "Table Name", "name" => "table_name", "type" => "select2", "dataenum" => $tables_list, 'required' => true];
        $this->form[] = ["label" => "Key", "type"=>"text", "name" => "key","help"=>'unique','required'=>true];
        
        
        $this->form[] = ["label" => "File name", "type"=>"text", "name" => "file_name","help"=>'Nama file ketika dicetak','required'=>true];
        $this->form[] = ["label" => "Ext", "type"=>"select2", "name" => "file_type","dataenum"=>'Word;Excel','required'=>true];
        $this->form[] = ["label" => "Tipe", "type"=>"select2", "name" => "type","dataenum"=>'Single Row;Batch Data','required'=>true];
        $this->form[] = ["label" => "File Template", "type"=>"upload", "name" => "file"];
        $this->form[] = ["label" => "Description", "type"=>"textarea", "name" => "description"];
        $this->form[] = ["label" => "Model", "type"=>"text", "name" => "model_path","help"=>'Laravel Eloquent Model ex: \App\PurchaseOrder, use if you need overwrite field with relation'];
        $this->form[] = ["label" => "Export PHP File", "type"=>"text", "name" => "export_php","help"=>'Maatwebsite/laravel-excel versi 3.1'];
        $this->form[] = ["label" => "Import PHP File", "type"=>"text", "name" => "import_php","help"=>'Maatwebsite/laravel-excel versi 3.1'];
        $this->form[] = ["label" => "Overwrite", "type"=>"wysiwyg", "name" => "overwrite_json","help"=>'Overwrite field at template with relation model. Json Type: Ex: { ["buyer_name" : "buyer.name"] }'];
        

        
    }

 
    public function migrate()
    {
        Artisan::call('migrate', [
            '--force' => true
        ]);

        CRUDBooster::redirectBack('Berhasil melakukan migration','success');
    }

    public function seed(Request $request)
    {
        if($request->has('class')){
            Artisan::call('db:seed');
        } else {
            Artisan::call('db:seed');
        }
        

        CRUDBooster::redirectBack('Berhasil melakukan seeding','success');
    }
}
