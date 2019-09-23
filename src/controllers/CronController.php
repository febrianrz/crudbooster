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

class CronController extends CBController
{
    public function cbInit()
    {
        $this->table = 'cms_crons';
        $this->primary_key = 'id';
        $this->title_field = "id";
        $this->button_bulk_action = true;
        $this->button_export = false;
        $this->button_import = false;
        $this->button_add = true;
        $this->button_edit = false;
        $this->button_delete = true;
        $this->global_privilege = false;

        $this->col = [];
        $this->col[] = ["label" => "ID", "name" => "id"];
        $this->col[] = ["label" => "Title", "name" => "title"];
        // $this->col[] = ["label" => "Time", "name" => "time_execute"];
        
        
        $this->form = [];
        $this->form[] = ["label" => "Title", "type"=>"text", "name" => "title",'validation'=>'required'];
        $this->form[] = ["label" => "File Path", "name" => "file_path", "type" => "text",'validation'=>'required'];
        // $this->form[] = ["label" => "Data", "type"=>"textarea", "name" => "data",'validation'=>'nullable'];
        // $this->form[] = ["label" => "Time Execute", "type"=>"select2", "name" => "time_execute",'validation'=>'nullable','dataenum'=>'Per 1 Menit;Per 5 Menit;Per 10 Menit;Per 15 Menit;Per 30 Menit;Per Jam;Per Hari'];
        $this->form[] = ["label" => "Status", "type"=>"select2", "name" => "is_active",'validation'=>'required','dataenum'=>'0|Tidak Aktif;1|Aktif'];
        
    }

    public function hook_after_add($id)
    {
        
        
    }

    
}
