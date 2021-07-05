<?php
namespace ProcessMaker\Package\Extended_pm_functions;

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{

    // Assign the default namespace for our controllers
    protected $namespace = '\ProcessMaker\Package\Extended_pm_functions\Http\Controllers';

    /**
     * If your plugin will provide any services, you can register them here.
     * See: https://laravel.com/docs/5.6/providers#the-register-method
     */
    public function register()
    {
        // Nothing is registered at this time
    }

    /**
     * After all service provider's register methods have been called, your boot method
     * will be called. You can perform any initialization code that is dependent on
     * other service providers at this time.  We've included some example behavior
     * to get you started.
     *
     * See: https://laravel.com/docs/5.6/providers#the-boot-method
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/console.php');

        /**
         * PM function md5($plain)
         * 
         * Usage:
         * 
         * Into an exclusive gateway outgoing flow:
         *      /\
         *     /  \---outgoing_flow--->
         *     \  /
         *      \/
         *  Expression: true
         *  Variable Name: form_output_1
         *  Value: md5(form_input_1)
         * 
         * Results:
         *  form_input_1 = sample
         *  form_output_1 = 5e8ff9bf55ba3508199d22e984129be6
         */
        app('workflow.FormalExpression')->registerPMFunction(
            'md5',
            function ($requestData, $plain) {
                return md5($plain);
            }
        );
    }
}
