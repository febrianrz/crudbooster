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

class MigrationController extends CBController
{
    public function cbInit()
    {
        $this->table = 'migrations';
        $this->primary_key = 'id';
        $this->title_field = "migration";
        $this->order_by = "id,desc";
        $this->button_bulk_action = true;
        $this->button_export = false;
        $this->button_import = false;
        $this->button_add = true;
        $this->button_edit = true;
        $this->button_delete = true;
        $this->global_privilege = false;

        $this->col = [];
        $this->col[] = ["label" => "ID", "name" => "id"];
        $this->col[] = ["label" => "Migration File", "name" => "migration"];
        $this->col[] = ["label" => "Batch", "name" => "batch"];

        $this->form = [];
        $tables = CRUDBooster::listTables();
        
        
        $this->form[] = ["label" => "Migration File", "type"=>"text", "name" => "migration","help"=>''];
        $this->form[] = ["label" => "Batch", "type"=>"text", "name" => "batch","help"=>'','validation'=>'required|numeric'];
        

        $this->index_button[] = [
            'label' => 'Migrate',
            'url'   => CRUDBooster::mainpath('migrate'),
            'icon'  => 'fa fa-gear',
            'color' => 'warning'
        ];
        $this->index_button[] = [
            'label' => 'Seed',
            'url'   => CRUDBooster::mainpath('seed'),
            'icon'  => 'fa fa-gear',
            'color' => 'danger'
        ];
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
