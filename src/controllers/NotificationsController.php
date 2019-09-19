<?php namespace crocodicstudio\crudbooster\controllers;

use CRUDBooster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Excel;
use Illuminate\Support\Facades\PDF;

class NotificationsController extends CBController
{
    public function cbInit()
    {
        $this->table = "cms_notifications";
        $this->primary_key = "id";
        $this->title_field = "content";
        $this->limit = 20;
        $this->index_orderby = ["id" => "desc"];
        $this->button_show = true;
        $this->button_add = false;
        $this->button_edit = false;
        $this->button_delete = false;
        $this->button_export = false;
        $this->button_import = false;
        $this->global_privilege = true;

        $read_notification_url = url(config('crudbooster.ADMIN_PATH')).'/notifications/read';

        $this->col = [];
        $this->col[] = ["label" => "Content", "name" => "content", "callback_php" => '"<a href=\"'.$read_notification_url.'/$row->id\">$row->content</a>"'];
        $this->col[] = [
            'label' => 'Read',
            'name' => 'is_read',
            'callback_php' => '($row->is_read)?"<span class=\"label label-default\">Already Read</span>":"<span class=\"label label-danger\">NEW</span>"',
        ];
        $this->col[] = ["label" => "At", "name" => "created_at"];

        $this->form = [];
        $this->form[] = ["label" => "Content", "name" => "content", "type" => "text"];
        $this->form[] = ["label" => "Icon", "name" => "icon", "type" => "text"];
        $this->form[] = ["label" => "Notification Command", "name" => "notification_command", "type" => "textarea"];
        $this->form[] = ["label" => "Is Read", "name" => "is_read", "type" => "text"];

        $this->index_button[] = [
            'label'     => 'Semua telah dibaca',
            'icon'      => 'fa fa-eye',
            'url'       => CRUDBooster::mainpath('setreadall'),
            'color'     => 'warning'
        ];
        
    }

    public function hook_query_index(&$query)
    {
        $query->where('id_cms_users', CRUDBooster::myId());
    }

    public function getLatestJson()
    {

        $rows = DB::table('cms_notifications')->where('id_cms_users', 0)->orWhere('id_cms_users', CRUDBooster::myId())->orderby('id', 'desc')->where('is_read', 0)->take(25);
        if (\Schema::hasColumn('cms_notifications', 'deleted_at')) {
            $rows->whereNull('deleted_at');
        }

        $total = count($rows->get());

        return response()->json(['items' => $rows->get(), 'total' => $total]);
    }

    public function getRead($id)
    {
        DB::table('cms_notifications')->where('id', $id)->update(['is_read' => 1]);
        $row = DB::table('cms_notifications')->where('id', $id)->first();
        if($row->url) return redirect($row->url);
        $this->hide_form 	  = ['icon','notification_command','is_read'];
        return $this->getDetail($id);
    }

    public function getSetreadall()
    {
        DB::table('cms_notifications')->where('id_cms_users', CRUDBooster::myId())
            ->update(['is_read'=>1]);
        CRUDBooster::redirectBack('Berhasil menandai telah dibaca','success');
    }
}