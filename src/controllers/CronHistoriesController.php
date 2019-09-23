<?php namespace crocodicstudio\crudbooster\controllers;



use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\PDF;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use crocodicstudio\crudbooster\controllers\CBController;

class CronHistoriesController extends CBController
{
    public function cbInit()
    {
        $this->table = 'cms_cron_histories';
        $this->primary_key = 'id';
        $this->title_field = "id";
        $this->button_bulk_action = true;
        $this->button_export = false;
        $this->button_import = false;
        $this->button_add = false;
        $this->button_edit = false;
        $this->button_delete = false;
        $this->global_privilege = false;

        $this->col = [];
        $this->col[] = ["label" => "ID", "name" => "id"];
        $this->col[] = ["label" => "CRON", "name" => "cms_cron_id","join"=>'cms_crons,title'];
        $this->col[] = ["label" => "Start At", "name" => "start_at"];
        $this->col[] = ["label" => "End At", "name" => "end_at"];
        $this->col[] = ["label" => "Status", "name" => "is_success"];
        $this->col[] = ["label" => "response", "name" => "response"];
        
        $this->form = [];
        $this->form[] = ["label" => "CRON", "type"=>"select2", "name" => "cms_cron_id", 'datatable'=>'cms_crons,title'];
        $this->form[] = ["label" => "start", "name" => "start_at", "type" => "text",'validation'=>'required'];
        $this->form[] = ["label" => "end", "name" => "end_at", "type" => "text",'validation'=>'required'];
        $this->form[] = ["label" => "Status", "name" => "is_success", "type" => "text",'validation'=>'required'];
        $this->form[] = ["label" => "response", "name" => "response", "type" => "text",'validation'=>'required'];
        // $this->form[] = ["label" => "Data", "type"=>"textarea", "name" => "data",'validation'=>'nullable'];
        // $this->form[] = ["label" => "Time Execute", "type"=>"select2", "name" => "time_execute",'validation'=>'nullable','dataenum'=>'Per 1 Menit;Per 5 Menit;Per 10 Menit;Per 15 Menit;Per 30 Menit;Per Jam;Per Hari'];
        $this->form[] = ["label" => "Status", "type"=>"select2", "name" => "is_active",'validation'=>'required','dataenum'=>'0|Tidak Aktif;1|Aktif'];
        
    }

    public function hook_after_add($id)
    {
        
        
    }

    
}
