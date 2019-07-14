<?php namespace Meysam\PutFormData;

use Backend;
use System\Classes\PluginBase;

/**
 * Cors Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Put Form Data',
            'description' => 'form-data is available only in POST method. This plugin makes them available in other methods like PUT and PATCH',
            'author'      => 'Meysam Mahfouzi',
            'icon'        => 'icon-snowflake-o'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        // Register middleware
        $this->app['Illuminate\Contracts\Http\Kernel']
            ->pushMiddleware('Meysam\PutFormData\Classes\FixputMiddleware');
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'meysam.putformdata.some_permission' => [
                'tab' => 'PutFormData',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [];
    }
}
