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

class SentEmailController extends CBController
{
    public function cbInit()
    {
        $this->table = 'cms_email_sents';
        $this->primary_key = 'id';
        $this->title_field = "subject";
        $this->button_bulk_action = true;
        $this->button_export = false;
        $this->button_import = false;
        $this->button_add = true;
        $this->button_edit = false;
        $this->button_delete = false;
        $this->global_privilege = false;

        $this->col = [];
        $this->col[] = ["label" => "ID", "name" => "id"];
        $this->col[] = ["label" => "Subject", "name" => "subject"];
        $this->col[] = ["label" => "To", "name" => "to"];
        $this->col[] = ["label" => "Body", "name" => "body"];
        $this->col[] = ["label" => "Created By", "name" => "cms_user_id", 'join'=>'cms_users,name'];
        $this->col[] = ["label" => "Created_at", "name" => "created_at"];
        
        $this->form = [];
        $this->form[] = ["label" => "To", "type"=>"email", "name" => "to","help"=>'email valid','validation'=>'required|email'];
        $this->form[] = ["label" => "Subject", "name" => "subject", "type" => "text",'validation'=>'required'];
        $this->form[] = ["label" => "Body", "type"=>"wysiwyg", "name" => "body",'validation'=>'required'];
        
    }

    public function hook_after_add($id)
    {
        $row = DB::table($this->table)->find($id);
        DB::table($this->table)->where('id',$id)->update([
            'cms_user_id'    => CRUDBooster::myId(),
        ]);
        CRUDBooster::sendEmail([
            'to'=>$row->to,
            'data'=>[],
            'template'=>'blank',
            'html'	=> $row->body,
            'subject'=> $row->subject
        ]);
        
    }

    
}
