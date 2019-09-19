<?php

use Illuminate\Database\Seeder;

class CBSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Please wait updating the data...');

        $this->call('Cms_usersSeeder');
        $this->call('Cms_modulsSeeder');
        $this->call('Cms_privilegesSeeder');
        $this->call('Cms_privileges_rolesSeeder');
        $this->call('Cms_settingsSeeder');
        $this->call('CmsEmailTemplates');
        $this->call('Cms_synctableSeeder');
        $this->call(CBUpdateModulSeeder::class);
        $this->command->info('Updating the data completed !');
    }
}

class Cms_usersSeeder extends Seeder {
     public function run()
    {
        DB::table('cms_users')->updateOrInsert([
            'email'     => 'admin@crudbooster.com',
        ],[
            'name'      => 'Superuser',
            'photo'     => NULL,
            'password'  => bcrypt('123456'),
            'id_cms_privileges' => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'status'    => 'Active'
        ]);
    }
}

class CmsEmailTemplates extends Seeder
{
    public function run()
    {
        DB::table('cms_email_templates')->updateOrInsert([
            'slug' => 'forgot_password_backend',
        ],[
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'Email Template Forgot Password Backend',
                
                'content' => '<p>Hi,</p><p>Someone requested forgot password, here is your new password : </p><p>[password]</p><p><br></p><p>--</p><p>Regards,</p><p>Admin</p>',
                'description' => '[password]',
                'from_name' => 'System',
                'from_email' => 'system@crudbooster.com',
                'cc_email' => null,
            ]);

        
    }
}

class Cms_settingsSeeder extends Seeder
{
    public function run()
    {

        $data = [

            //LOGIN REGISTER STYLE
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'login_background_color',
                'label' => 'Login Background Color',
                'content' => null,
                'content_input_type' => 'text',
                'group_setting' => trans('crudbooster.login_register_style'),
                'dataenum' => null,
                'helper' => 'Input hexacode',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'login_font_color',
                'label' => 'Login Font Color',
                'content' => null,
                'content_input_type' => 'text',
                'group_setting' => trans('crudbooster.login_register_style'),
                'dataenum' => null,
                'helper' => 'Input hexacode',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'login_background_image',
                'label' => 'Login Background Image',
                'content' => null,
                'content_input_type' => 'upload_image',
                'group_setting' => trans('crudbooster.login_register_style'),
                'dataenum' => null,
                'helper' => null,
            ],

            //EMAIL SETTING
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'email_sender',
                'label' => 'Email Sender',
                'content' => 'support@crudbooster.com',
                'content_input_type' => 'text',
                'group_setting' => trans('crudbooster.email_setting'),
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'smtp_driver',
                'label' => 'Mail Driver',
                'content' => 'mail',
                'content_input_type' => 'select',
                'group_setting' => trans('crudbooster.email_setting'),
                'dataenum' => 'smtp,mail,sendmail',
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'smtp_host',
                'label' => 'SMTP Host',
                'content' => '',
                'content_input_type' => 'text',
                'group_setting' => trans('crudbooster.email_setting'),
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'smtp_port',
                'label' => 'SMTP Port',
                'content' => '25',
                'content_input_type' => 'text',
                'group_setting' => trans('crudbooster.email_setting'),
                'dataenum' => null,
                'helper' => 'default 25',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'smtp_username',
                'label' => 'SMTP Username',
                'content' => '',
                'content_input_type' => 'text',
                'group_setting' => trans('crudbooster.email_setting'),
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'smtp_password',
                'label' => 'SMTP Password',
                'content' => '',
                'content_input_type' => 'text',
                'group_setting' => trans('crudbooster.email_setting'),
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'email_header_app',
                'label' => 'Email Header',
                'content' => 'ALTBooster',
                'content_input_type' => 'text',
                'group_setting' => trans('crudbooster.email_setting'),
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'email_footer_top',
                'label' => 'Email Footer Top',
                'content' => 'Powered By: ALTBooster',
                'content_input_type' => 'text',
                'group_setting' => trans('crudbooster.email_setting'),
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'email_footer_bottom',
                'label' => 'Email Footer Bottom',
                'content' => 'ALTBooster',
                'content_input_type' => 'text',
                'group_setting' => trans('crudbooster.email_setting'),
                'dataenum' => null,
                'helper' => null,
            ],

            //Telegram Setting
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'telegram_api_token',
                'label' => 'API Token',
                'content' => '',
                'content_input_type' => 'text',
                'group_setting' => 'Telegram Setting',
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'telegram_channel_id',
                'label' => 'Channel ID',
                'content' => '',
                'content_input_type' => 'text',
                'group_setting' => 'Telegram Setting',
                'dataenum' => null,
                'helper' => null,
            ],

            //APPLICATION SETTING
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'appname',
                'label' => 'Application Name',
                'group_setting' => trans('crudbooster.application_setting'),
                'content' => 'CRUDBooster',
                'content_input_type' => 'text',
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'default_paper_size',
                'label' => 'Default Paper Print Size',
                'group_setting' => trans('crudbooster.application_setting'),
                'content' => 'Legal',
                'content_input_type' => 'text',
                'dataenum' => null,
                'helper' => 'Paper size, ex : A4, Legal, etc',
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'logo',
                'label' => 'Logo',
                'content' => '',
                'content_input_type' => 'upload_image',
                'group_setting' => trans('crudbooster.application_setting'),
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'favicon',
                'label' => 'Favicon',
                'content' => '',
                'content_input_type' => 'upload_image',
                'group_setting' => trans('crudbooster.application_setting'),
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'api_debug_mode',
                'label' => 'API Debug Mode',
                'content' => 'true',
                'content_input_type' => 'select',
                'group_setting' => trans('crudbooster.application_setting'),
                'dataenum' => 'true,false',
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'google_api_key',
                'label' => 'Google API Key',
                'content' => '',
                'content_input_type' => 'text',
                'group_setting' => trans('crudbooster.application_setting'),
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'google_fcm_key',
                'label' => 'Google FCM Key',
                'content' => '',
                'content_input_type' => 'text',
                'group_setting' => trans('crudbooster.application_setting'),
                'dataenum' => null,
                'helper' => null,
            ],

            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'recaptcha_version',
                'label' => 'Recaptcha Version',
                'content' => null,
                'content_input_type' => 'text',
                'group_setting' => 'Third Party Config',
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'recaptcha_site_key',
                'label' => 'Recaptcha Site Key',
                'content' => null,
                'content_input_type' => 'text',
                'group_setting' => 'Third Party Config',
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'recaptcha_server_key',
                'label' => 'Recaptcha Server Key',
                'content' => null,
                'content_input_type' => 'text',
                'group_setting' => 'Third Party Config',
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'sso_host',
                'label' => 'SSO Host',
                'content' => null,
                'content_input_type' => 'text',
                'group_setting' => 'Third Party Config',
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'sso_uri',
                'label' => 'SSO URI',
                'content' => null,
                'content_input_type' => 'text',
                'group_setting' => 'Third Party Config',
                'dataenum' => null,
                'helper' => null,
            ],
            [
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'sso_port',
                'label' => 'SSO Port',
                'content' => null,
                'content_input_type' => 'text',
                'group_setting' => 'Third Party Config',
                'dataenum' => null,
                'helper' => null,
            ],
        ];

        foreach ($data as $row) {
            $count = DB::table('cms_settings')->where('name', $row['name'])->count();
            if ($count) {
                if ($count > 1) {
                    $newsId = DB::table('cms_settings')->where('name', $row['name'])->orderby('id', 'asc')->take(1)->first();
                    DB::table('cms_settings')->where('name', $row['name'])->where('id', '!=', $newsId->id)->delete();
                }
                continue;
            }
            DB::table('cms_settings')->insert($row);
        }
    }
}

class Cms_privileges_rolesSeeder extends Seeder
{
    public function run()
    {

        if (DB::table('cms_privileges_roles')->count() == 0) {
            $modules = DB::table('cms_moduls')->get();
            $i = 1;
            foreach ($modules as $module) {

                $is_visible = 1;
                $is_create = 1;
                $is_read = 1;
                $is_edit = 1;
                $is_delete = 1;

                switch ($module->table_name) {
                    case 'cms_logs':
                        $is_create = 0;
                        $is_edit = 0;
                        break;
                    case 'cms_privileges_roles':
                        $is_visible = 0;
                        break;
                    case 'cms_apicustom':
                        $is_visible = 0;
                        break;
                    case 'cms_notifications':
                        $is_create = $is_read = $is_edit = $is_delete = 0;
                        break;
                }

                DB::table('cms_privileges_roles')->insert([
                    'created_at' => date('Y-m-d H:i:s'),
                    'is_visible' => $is_visible,
                    'is_create' => $is_create,
                    'is_edit' => $is_edit,
                    'is_delete' => $is_delete,
                    'is_read' => $is_read,
                    'id_cms_privileges' => 1,
                    'id_cms_moduls' => $module->id,
                ]);
                $i++;
            }
        }
    }
}

class Cms_privilegesSeeder extends Seeder
{
    public function run()
    {

        if (DB::table('cms_privileges')->where('name', 'Super Administrator')->count() == 0) {
            DB::table('cms_privileges')->insert([
                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'Super Administrator',
                'is_superadmin' => 1,
                'theme_color' => 'skin-red',
            ]);
        }
    }
}

class Cms_modulsSeeder extends Seeder
{
    public function run()
    {

        /* 
            1 = Public
            2 = Setting        
        */

        $data = [
            [

                'created_at' => date('Y-m-d H:i:s'),
                'name' => trans('crudbooster.Notifications'),
                'icon' => 'fa fa-cog',
                'path' => 'notifications',
                'table_name' => 'cms_notifications',
                'controller' => 'NotificationsController',
                'is_protected' => 1,
                'is_active' => 1,
            ],
            [

                'created_at' => date('Y-m-d H:i:s'),
                'name' => trans('crudbooster.Privileges'),
                'icon' => 'fa fa-cog',
                'path' => 'privileges',
                'table_name' => 'cms_privileges',
                'controller' => 'PrivilegesController',
                'is_protected' => 1,
                'is_active' => 1,
            ],
            [

                'created_at' => date('Y-m-d H:i:s'),
                'name' => trans('crudbooster.Privileges_Roles'),
                'icon' => 'fa fa-cog',
                'path' => 'privileges_roles',
                'table_name' => 'cms_privileges_roles',
                'controller' => 'PrivilegesRolesController',
                'is_protected' => 1,
                'is_active' => 1,
            ],
            [

                'created_at' => date('Y-m-d H:i:s'),
                'name' => trans('crudbooster.Users_Management'),
                'icon' => 'fa fa-users',
                'path' => 'users',
                'table_name' => 'cms_users',
                'controller' => 'AdminCmsUsersController',
                'is_protected' => 0,
                'is_active' => 1,
            ],
            [

                'created_at' => date('Y-m-d H:i:s'),
                'name' => trans('crudbooster.settings'),
                'icon' => 'fa fa-cog',
                'path' => 'settings',
                'table_name' => 'cms_settings',
                'controller' => 'SettingsController',
                'is_protected' => 1,
                'is_active' => 1,
            ],
            [

                'created_at' => date('Y-m-d H:i:s'),
                'name' => trans('crudbooster.Module_Generator'),
                'icon' => 'fa fa-database',
                'path' => 'module_generator',
                'table_name' => 'cms_moduls',
                'controller' => 'ModulsController',
                'is_protected' => 1,
                'is_active' => 1,
            ],
            [

                'created_at' => date('Y-m-d H:i:s'),
                'name' => trans('crudbooster.Menu_Management'),
                'icon' => 'fa fa-bars',
                'path' => 'menu_management',
                'table_name' => 'cms_menus',
                'controller' => 'MenusController',
                'is_protected' => 1,
                'is_active' => 1,
            ],
            [

                'created_at' => date('Y-m-d H:i:s'),
                'name' => trans('crudbooster.Email_Templates'),
                'icon' => 'fa fa-envelope-o',
                'path' => 'email_templates',
                'table_name' => 'cms_email_templates',
                'controller' => 'EmailTemplatesController',
                'is_protected' => 1,
                'is_active' => 1,
            ],
            [

                'created_at' => date('Y-m-d H:i:s'),
                'name' => trans('crudbooster.Statistic_Builder'),
                'icon' => 'fa fa-dashboard',
                'path' => 'statistic_builder',
                'table_name' => 'cms_statistics',
                'controller' => 'StatisticBuilderController',
                'is_protected' => 1,
                'is_active' => 1,
            ],
            [

                'created_at' => date('Y-m-d H:i:s'),
                'name' => trans('crudbooster.API_Generator'),
                'icon' => 'fa fa-cloud-download',
                'path' => 'api_generator',
                'table_name' => '',
                'controller' => 'ApiCustomController',
                'is_protected' => 1,
                'is_active' => 1,
            ],
            [

                'created_at' => date('Y-m-d H:i:s'),
                'name' => trans('crudbooster.Log_User_Access'),
                'icon' => 'fa fa-flag-o',
                'path' => 'logs',
                'table_name' => 'cms_logs',
                'controller' => 'LogsController',
                'is_protected' => 1,
                'is_active' => 1,
            ],
            [

                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'Sync Table',
                'icon' => 'fa fa-flag-o',
                'path' => 'sync_table',
                'table_name' => 'cms_sync_tables',
                'controller' => 'SynctableController',
                'is_protected' => 1,
                'is_active' => 1,
            ],
            [

                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'Email Log',
                'icon' => 'fa fa-flag-o',
                'path' => 'log_email',
                'table_name' => 'cms_email_logs',
                'controller' => 'LogEmailsController',
                'is_protected' => 1,
                'is_active' => 1,
            ],
            [

                'created_at' => date('Y-m-d H:i:s'),
                'name' => 'Kirim Email',
                'icon' => 'fa fa-envelope',
                'path' => 'sent_email',
                'table_name' => 'cms_email_sents',
                'controller' => 'SentEmailController',
                'is_protected' => 0,
                'is_active' => 1,
            ],
        ];

        foreach ($data as $k => $d) {
            if (DB::table('cms_moduls')->where('name', $d['name'])->count()) {
                unset($data[$k]);
            }
        }

        DB::table('cms_moduls')->insert($data);
    }
}


class Cms_synctableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cms_sync_tables')->updateOrInsert([
            'table_name'    => 'cms_menus',
        ],[
            'column_key'    => 'type,path',
            'is_active'     => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'approach'      => 2,
            'export_path'   => 'crocodicstudio\crudbooster\exports\CmsMenuExport',
            'import_path'   => 'crocodicstudio\crudbooster\imports\CmsMenuImport',
        ]);
        
        DB::table('cms_sync_tables')->updateOrInsert([
            'table_name'    => 'cms_moduls',
        ],[
            'column_key'    => 'path,table_name',
            'is_active'     => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'approach'      => 2,
            'export_path'   => 'crocodicstudio\crudbooster\exports\CmsModulExport',
            'import_path'   => 'crocodicstudio\crudbooster\imports\CmsModulImport',
        ]);

        DB::table('cms_sync_tables')->updateOrInsert([
            'table_name'    => 'cms_privileges',
        ],[
            'column_key'    => 'name',
            'is_active'     => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'approach'      => 2,
            'export_path'   => 'crocodicstudio\crudbooster\exports\CmsPrivilegesExport',
            'import_path'   => 'crocodicstudio\crudbooster\imports\CmsPrivilegesImport',
            
        ]);

        DB::table('cms_sync_tables')->updateOrInsert([
            'table_name'    => 'cms_settings',
        ],[
            'column_key'    => 'name',
            'is_active'     => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'approach'      => 2,
            'export_path'   => 'crocodicstudio\crudbooster\exports\CmsSettingExport',
            'import_path'   => 'crocodicstudio\crudbooster\imports\CmsSettingImport',
        ]);

        DB::table('cms_sync_tables')->updateOrInsert([
            'table_name'    => 'cms_sync_tables',
        ],[
            'column_key'    => 'table_name',
            'is_active'     => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'approach'      => 2,
            'export_path'   => 'crocodicstudio\crudbooster\exports\CmsSyncTableExport',
            'import_path'   => 'crocodicstudio\crudbooster\imports\CmsSyncTableImport',
        ]);

        DB::table('cms_sync_tables')->updateOrInsert([
            'table_name'    => 'cms_email_templates',
        ],[
            'column_key'    => 'slug',
            'is_active'     => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'approach'      => 2,
            'export_path'   => 'crocodicstudio\crudbooster\exports\CmsEmailTemplateExport',
            'import_path'   => 'crocodicstudio\crudbooster\imports\CmsEmailTemplateImport',
        ]);

        DB::table('cms_sync_tables')->updateOrInsert([
            'table_name'    => 'cms_printout_templates',
        ],[
            'column_key'    => 'slug',
            'is_active'     => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'approach'      => 2,
            'export_path'   => 'crocodicstudio\crudbooster\exports\CmsPrintoutTemplateExport',
            'import_path'   => 'crocodicstudio\crudbooster\imports\CmsPrintoutTemplateImport',
        ]);

        DB::table('cms_sync_tables')->updateOrInsert([
            'table_name'    => 'cms_privileges_roles',
        ],[
            'column_key'    => 'slug',
            'is_active'     => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'approach'      => 2,
            'export_path'   => 'crocodicstudio\crudbooster\exports\CmsPrivilegesRolesExport',
            'import_path'   => 'crocodicstudio\crudbooster\imports\CmsPrivilegesRolesImport',
        ]);

        DB::table('cms_sync_tables')->updateOrInsert([
            'table_name'    => 'cms_menus_privileges',
        ],[
            'column_key'    => 'slug',
            'is_active'     => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'approach'      => 2,
            'export_path'   => 'crocodicstudio\crudbooster\exports\CmsMenusPrivilegesExport',
            'import_path'   => 'crocodicstudio\crudbooster\imports\CmsMenusPrivilegesImport',
        ]);
    }
}

