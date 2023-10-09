<?php

namespace Packagit\Dcat;

use Packagit\Dcat\Models\ConfigModel;
use Dcat\Admin\Extend\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    protected $js = [
        'js/index.js',
    ];
    protected $css = [
        'css/index.css',
    ];

    protected $menu = [
        'parent' => 2,
        'title'  => '配置',
        'uri'    => 'config',
        'icon'   => 'fa-toggle-on',
    ];

    public function register()
    {
    }

    public function init()
    {
        parent::init();
        $tableName = (new ConfigModel)->getTable();
        if ((new ConfigModel)->getConnection()->getSchemaBuilder()->hasTable($tableName)) {
            foreach (ConfigModel::all() as $config) {
                config([$config['name'] => $config['value']]);
            }
        }
    }

    public function settingForm()
    {
        return new Setting($this);
    }
}
