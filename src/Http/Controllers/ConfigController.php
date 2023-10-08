<?php

namespace Packagit\Dcat\Http\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Admin;
use Dcat\Admin\Layout\Content;
use Packagit\Dcat\Models\ConfigModel;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Http\Controllers\HasResourceActions;

class ConfigController extends AdminController
{
    use HasResourceActions;

    protected $title = '配置';

    public function grid()
    {
        $grid = new Grid(new ConfigModel());

        $grid->id('ID')->sortable();
        $grid->name('键名')->display(function ($name) {
            return "<a tabindex=\"0\" class=\"btn btn-xs btn-twitter\" role=\"button\" data-toggle=\"popover\" data-html=true title=\"Usage\" data-content=\"<code>config('$name');</code>\">$name</a>";
        });
        $grid->value('键值');

        $grid->created_at();
        $grid->updated_at();
        $grid->enableDialogCreate();

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->like('name', '键名');
            $filter->like('value', '键值');
        });

        return $grid;
    }

    protected function detail($id)
    {
        return Show::make($id, new ConfigModel(), function (Show $show) {
            $show->id();
            $show->name('键名');
            $show->value('键值');
            $show->description('备注');
            $show->created_at();
            $show->updated_at();
        });
    }

    public function form()
    {
        $form = new Form(new ConfigModel());

        $form->display('id', 'ID');
        $form->text('name', '键名')->rules('required');
        $form->textarea('value', '键值')->rules('required');
        $form->textarea('description', '备注');

        $form->display('created_at');
        $form->display('updated_at');

        return $form;
    }
}
