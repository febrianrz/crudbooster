<?php namespace crocodicstudio\crudbooster\controllers;



use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\PDF;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
<<<<<<< HEAD
=======
use crocodicstudio\crudbooster\exports\CmsMenuExport;
>>>>>>> master
use crocodicstudio\crudbooster\controllers\CBController;

class SynctableController extends CBController
{
    public function cbInit()
    {
        $this->table = 'cms_sync_tables';
        $this->primary_key = 'id';
        $this->title_field = "table_name";
        $this->button_bulk_action = true;
        $this->button_export = false;
        $this->button_import = false;
        $this->button_add = true;
        $this->button_edit = true;
        $this->button_delete = true;
        $this->global_privilege = false;

        $this->col = [];
        $this->col[] = ["label" => "Table", "name" => "table_name"];
        $this->col[] = ["label" => "Column Key", "name" => "column_key"];
        $this->col[] = ["label" => "Approach", "name" => "approach","callback_php"=>'$this->getApproachLabel($row->approach)'];
<<<<<<< HEAD
=======
        $this->col[] = ["label" => "Exportable", "name" => "export_path"];
        $this->col[] = ["label" => "Importable", "name" => "import_path"];
>>>>>>> master
        $this->col[] = ["label" => "Status", "name" => "is_active"];

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
        $this->form[] = ["label" => "Column Name", "type"=>"text", "name" => "column_key","help"=>'use comma , for multi column unique key'];
<<<<<<< HEAD
=======
        $this->form[] = ["label" => "Exportable PHP File", "type"=>"text", "name" => "export_path","help"=>'Exportfile configuration Laravel-Excel 3.1'];
        $this->form[] = ["label" => "Importable PHP File", "type"=>"text", "name" => "import_path","help"=>'Importable configuration Laravel-Excel 3.1'];
>>>>>>> master
        $this->form[] = [
            "label" => "Approach When Insert", 
            "type"=>"select2", 
            "dataenum"=>"0|Delete And Create New;1|Update Or Create;2|Skip Or Create",
            "value"=>1,
            "name" => "approach"
        ];
        $this->form[] = [
            "label" => "Status", 
            "type"=>"radio", 
            "dataenum"=>"0|Tidak Aktif;1|Aktif",
            "name" => "is_active",
            "value"=> 1
        ];


        if(CRUDBooster::getCurrentMethod() == "getIndex"){
            $this->index_button[] = [
                'label' => 'Export Sync',
                'url'   => CRUDBooster::mainpath('export_sync'),
                'icon'  => 'fa fa-download',
                'color' => 'warning'
            ];
            $this->index_button[] = [
                'label' => 'Clear Cache',
                'url'   => CRUDBooster::mainpath('clear_sync'),
                'icon'  => 'fa fa-times',
                'color' => 'danger'
            ];
            $this->index_button[] = [
                'label' => 'Import Sync',
                'url'   => CRUDBooster::mainpath('import_sync'),
                'icon'  => 'fa fa-refresh',
                'color' => 'info'
            ];
        }
    }

    public function getApproachLabel($id)
    {
        switch($id){
            case 0: return "Delete And Create New";
            case 1: return "Update Or Create";
            case 2: return "Skip Or Create";
            default: return "-";
        }
    }
 
    
    public function export_sync ()
    {
        $date = date('YmdHis');
        
        $path = base_path(config('crudbooster.SYNC_TABLE_TEMP_PATH','temp/febrianrz/crudbooster'));
<<<<<<< HEAD

        foreach(DB::table('cms_sync_tables')->where('is_active',1)->get() as $c){
            Excel::create($c->table_name.$date, function($excel) use($c){
                
                // Set the title
                $excel->setTitle($c->table_name);
                // Chain the setters
                $excel->setCreator('Febrian Reza')
                      ->setCompany('Alter Indonesia');
            
                // Call them separately
                $excel->setDescription('Tabel Syncronize');

                $excel->sheet($c->table_name, function($sheet) use($c){
                    $datas = DB::table($c->table_name)->get();
                    $field_array = Schema::getColumnListing($c->table_name);
                    $fields = [];
                    
                    foreach($field_array as $k => $v){
                        if($v == "id") continue;
                        array_push($fields,$v);
                    }
                    // dd($fields);
                    $sheet->row(1,$fields);
                   
                    $i = 2;
                    
                    foreach($datas as $k){
                        $rowArray = (array) $k;
                        $fields_row = [];
                        foreach($fields as $f){
                            array_push($fields_row,$rowArray[$f]);
                        }
                        $sheet->row($i,$fields_row);
                        $i++;
                    }
                });
            
            })->store('csv', $path.'sync_table');
=======
        // return (new CmsMenuExport)->download('invoices.xlsx');
        foreach(DB::table('cms_sync_tables')->where('is_active',1)->get() as $c){
            $exportFile = new $c->export_path;
            Excel::store($exportFile, "temp/febrianrz/crudbooster/{$c->table_name}-{$date}.csv");
>>>>>>> master
        }
        Storage::put(config('crudbooster.SYNC_TABLE_TEMP_PATH','temp/febrianrz/crudbooster').'sync_table_id.txt', $date);
        CRUDBooster::redirectBack("Berhasil membuat file syncronize {$date}","success");
    }

    public function clear_sync()
    {
<<<<<<< HEAD
        $path = base_path(config('crudbooster.SYNC_TABLE_TEMP_PATH','temp/febrianrz/crudbooster/sync_table'));
=======
        $path = storage_path("app/temp/febrianrz/crudbooster");
>>>>>>> master
        $file = new Filesystem;
        $file->cleanDirectory($path);
        CRUDBooster::redirectBack("Berhasil membersihkan cache","success");
    }

    public function import_sync ()
    {
        $id_path = config('crudbooster.SYNC_TABLE_TEMP_PATH','temp/febrianrz/crudbooster').'sync_table_id.txt';
        $last_id = File::get(storage_path("app/".$id_path));
<<<<<<< HEAD
        $file_path = base_path(config('crudbooster.SYNC_TABLE_TEMP_PATH','temp/febrianrz/crudbooster'));
=======
        $file_path = storage_path("app/temp/febrianrz/crudbooster");
>>>>>>> master
        
        DB::beginTransaction();
        try {
            foreach(DB::table('cms_sync_tables')->where('is_active',1)->get() as $c){
<<<<<<< HEAD
                $file_path2 = $file_path."sync_table/{$c->table_name}{$last_id}.csv";
                if(file_exists($file_path2)){
                    Excel::load($file_path2, function($reader) use($c){
                        $columns = explode(",",$c->column_key);
                        $results = $reader->toArray();
                        foreach($results as $k => $v){
                            $wheres = [];
                            foreach($columns as $ckey){
                                $wheres[$ckey] = $v[$ckey];
                            }
                            
                            switch($c->approach){
                                case 0:
                                    // delete dulu baru insert
                                    DB::table($c->table_name)->where($wheres)->delete();
                                    DB::table($c->table_name)->insert($v);
                                break;
                                case 1:
                                    DB::table($c->table_name)->updateOrInsert($wheres,$v);
                                break;
                                case 2:
                                    $exists = DB::table($c->table_name)->where($wheres)->first();
                                    if(!$exists){
                                        DB::table($c->table_name)->insert($v);
                                    }
                                break;
                            }
                        }
                    });
=======
                $file_path2 = $file_path."/{$c->table_name}-{$last_id}.csv";
                if(file_exists($file_path2)){
                    $importFile = new $c->import_path;
                    Excel::import($importFile, $file_path2);
                    // ($importFile)->import($file_path2, null, \Maatwebsite\Excel\Excel::CSV);
                    // Excel::load($file_path2, function($reader) use($c){
                    //     $columns = explode(",",$c->column_key);
                    //     $results = $reader->toArray();
                    //     foreach($results as $k => $v){
                    //         $wheres = [];
                    //         foreach($columns as $ckey){
                    //             $wheres[$ckey] = $v[$ckey];
                    //         }
                            
                    //         switch($c->approach){
                    //             case 0:
                    //                 // delete dulu baru insert
                    //                 DB::table($c->table_name)->where($wheres)->delete();
                    //                 DB::table($c->table_name)->insert($v);
                    //             break;
                    //             case 1:
                    //                 DB::table($c->table_name)->updateOrInsert($wheres,$v);
                    //             break;
                    //             case 2:
                    //                 $exists = DB::table($c->table_name)->where($wheres)->first();
                    //                 if(!$exists){
                    //                     DB::table($c->table_name)->insert($v);
                    //                 }
                    //             break;
                    //         }
                    //     }
                    // });
>>>>>>> master
                } else {
                    throw new \Exception("{$file_path2} tidak ditemukan");
                }
            }

            
            DB::commit();
            
        } catch(\Exception $e){
            
            DB::rollback();
            
            dd($e->getMessage());
        }
        CRUDBooster::redirectBack("Berhasil melakukan syncronisasi tabel","success");
    }
}
