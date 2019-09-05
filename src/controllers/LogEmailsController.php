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

class LogEmailsController extends CBController
{
    public function cbInit()
    {
        $this->table = 'cms_email_logs';
        $this->primary_key = 'id';
        $this->title_field = "id";
        $this->order_by = "id,desc";
        $this->button_bulk_action = true;
        $this->button_export = false;
        $this->button_import = false;
        $this->button_add = false;
        $this->button_edit = false;
        $this->button_delete = false;
        $this->global_privilege = false;

        $this->col = [];
        $this->col[] = ["label" => "To", "name" => "to"];
        $this->col[] = ["label" => "At", "name" => "created_at"];
        $this->col[] = ["label" => "Status", "name" => "status"];

        $this->form = [];
        $this->form[] = ["label" => "Created At", "name" => "created_at", "type" => "text"];
        $this->form[] = ["label" => "Status", "name" => "status", "type" => "text"];
        $this->form[] = ["label" => "From", "name" => "from", "type" => "text"];
        $this->form[] = ["label" => "To", "name" => "to", "type" => "text"];
        $this->form[] = ["label" => "Subject", "name" => "subject", "type" => "wysiwyg"];
        $this->form[] = ["label" => "Body", "name" => "body", "type" => "wysiwyg"];
        $this->form[] = ["label" => "Response", "name" => "response", "type" => "text"];
        // $this->form[] = ["label" => "By", "name" => "cms_user_id", "type" => "text"];
    }
}
