<?php

use Illuminate\Database\Seeder;

class CBSyncTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Please wait updating the data...');
        $this->call('Cms_menuSeeder');

        $this->command->info('Updating the data completed !');
    }

}

class CmsEmailTemplates extends Seeder
{
    public function run()
    {
        
    }

}