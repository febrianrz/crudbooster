<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CBUpdateModulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Please wait updating the data...');
        $this->call('AddMigrationModul');
        $this->command->info('Updating the data completed !');
    }

}


class AddMigrationModul extends Seeder {
    public function run()
   {
        DB::table('cms_moduls')->updateOrInsert([
            'name' => 'Migration',
            'icon' => 'fa fa-database',
            'path' => 'migrations',
            'table_name' => 'migrations',
            'controller' => 'MigrationController',
        ],[
            'created_at' => date('Y-m-d H:i:s'),
            'is_protected' => 1,
            'is_active' => 1,
        ]);
   }
}