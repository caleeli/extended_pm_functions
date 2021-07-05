<?php

namespace ProcessMaker\Package\Extended_pm_functions\Seeds;

use ProcessMaker\Models\Screen;
use ProcessMaker\Models\Script;
use ProcessMaker\Models\Process;
use ProcessMaker\Models\Setting;
use ProcessMaker\Packages\Connectors\Email\EmailConfig;

class PackageSeeder
{

    /**
     * Creates or updates the script implementation.
     *
     * @return void
     */
    public static function install()
    {
        // Install Screens
        // @todo screen by key is not working
        Screen::unguard();
        $fields = \json_decode(file_get_contents(__DIR__ . '/screens/showUser.json'), true);
        Screen::updateOrCreate([
                'key' => 'show_user',
            ],
            $fields
        );
        Screen::reguard();

        // Install Scripts
        Script::unguard();
        $code = file_get_contents(__DIR__ . '/scripts/getUsers.php');
        Script::updateOrCreate([
                'key' => 'get_users',
            ],
            [
                'key' => 'get_users',
                'title' => 'Get Users (paquete)',
                'description' => 'Get Users (paquete)',
                'language' => 'PHP',
                'run_as_user_id' => Script::defaultRunAsUser()->id,
                'code' => $code,
            ]
        );
        Script::reguard();

        // Install Processes
        Process::unguard();
        Process::updateOrCreate([
            'package_key' => 'sub_process',
        ], [
            'name' => 'Sub Process (paquete)',
            'process_category_id' => 1,
            'description' => 'Sub Process (paquete)',
            'bpmn' => file_get_contents(__DIR__ . '/processes/sub_process.bpmn'),
            'user_id' => \ProcessMaker\Models\User::first()->id,
        ]);
        Process::updateOrCreate([
            'package_key' => 'main_process',
        ], [
            'name' => 'Main Process (paquete)',
            'process_category_id' => 2,
            'description' => 'Main Process (paquete)',
            'bpmn' => file_get_contents(__DIR__ . '/processes/main_process.bpmn'),
            'user_id' => \ProcessMaker\Models\User::first()->id,
        ]);
        Process::reguard();

        // Instalar settings
        // format: text, textarea, choice, boolean, object, array, checkboxes
    
        Setting::unguard();
        Setting::updateOrCreate([
            'key' => "extended_pm_setting1",
        ], [
            'format' => 'text',
            'config' => '123',
            'name' => 'Setting Uno',
            'helper' => 'Ejemplo de setting uno',
            'group' => 'Ellucian_Settings',
            'hidden' => false,
            'ui' => '{}',
        ]);
        Setting::updateOrCreate([
            'key' => "extended_pm_setting2",
        ], [
            'format' => 'text',
            'config' => '123',
            'name' => 'Setting Dos',
            'helper' => 'Ejemplo de setting dos',
            'group' => 'Ellucian_Settings',
            'hidden' => false,
            'ui' => '{}',
        ]);
        Setting::updateOrCreate([
            'key' => "extended_pm_setting3",
        ], [
            'format' => 'checkboxes',
            'config' => null,
            'name' => 'Groups To Import',
            'helper' => 'Select which LDAP groups to import',
            'group' => 'Ellucian_Settings',
            'hidden' => false,
            'ui' => [
                'dynamic' => [
                    'url' => '/users',
                    'response' => 'data',
                ],
                'switches' => true,
                'order' => 750,
            ],
        ]);
        Setting::reguard();
    }

    public function uninstall()
    {
        Screen::where('key', 'show_user')->delete();
        Script::where('key', 'get_users')->delete();
        Process::where('package_key', 'sub_process')->delete();
        Process::where('package_key', 'main_process')->delete();
        Setting::where('group', 'Ellucian_Settings')->delete();
    }
}
