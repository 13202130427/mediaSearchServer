<?php


namespace App\Admin\Controllers\Admin;


use App\Libraries\Base\BaseAdminController;
use App\Models\Admin\Platform;
use App\Models\Vip\VipLevel;
use Encore\Admin\Grid;
use Encore\Admin\Form;

class PlatformController extends BaseAdminController
{
    use \App\Libraries\Base\Platform;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '平台';

    /**
     * @var Platform
     */
    protected $model;

    /**
     * @var
     */
    protected $service;

    public function __construct(Platform $model)
    {
        $this->model = $model;
    }
    /**
     * 表格
     * @return Grid
     * @throws \Exception
     */
    protected function grid()
    {
        $grid = new Grid($this->model);
        $grid->model()->latest();

        $grid->column('id', 'ID');
        $grid->column('name', '平台名称')->editable();
        $grid->vipLevel()->name("等级");
        $status = [
            'on' => ['value'=>1,'text'=>'启用','color'=>'primary'],
            'off' => ['value'=>0,'text'=>'禁用','color'=>'default']
        ];
        $grid->column('status', '状态')->switch($status);
        $grid->column('created_at', '创建时间');


        $grid->actions(function ($actions) {
        });

        return $grid;
    }

    /**
     *
     */
    protected function form()
    {
        $form = new Form($this->model);
        $form->text('name', '平台名称');
        $status = [
            'on' => ['value'=>1,'text'=>'启用','color'=>'primary'],
            'off' => ['value'=>0,'text'=>'禁用','color'=>'default']
        ];
        $form->switch('status','状态')->states($status);
        $form->saving(function (Form $form) {
            if ($form->isCreating()) $form->model()->id = app('snowFlake')->id;
            $form->model()->vip_level = VipLevel::$defaultLevel;
        });

        return $form;
    }

}
