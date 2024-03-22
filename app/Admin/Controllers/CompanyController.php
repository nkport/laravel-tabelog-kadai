<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '会社情報';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Company());

        $grid->column('id', __('ID'));
        $grid->column('company_name', __('会社名'));
        $grid->column('establishment_date', __('設立'));
        $grid->column('address', __('所在地'));
        $grid->column('capital', __('資本金'));
        $grid->column('representative', __('代表者'));
        $grid->column('description', __('事業内容'));
        $grid->column('suppliers', __('主な取引先'));
        $grid->column('suppliers_bank', __('取引銀行'));
        $grid->column('history', __('会社沿革'));
        $grid->column('contact', __('お問い合わせ'));
        $grid->column('tel', __('電話番号'));
        $grid->column('created_at', __('登録日'));
        $grid->column('updated_at', __('更新日'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Company::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('company_name', __('会社名'));
        $show->field('establishment_date', __('設立'));
        $show->field('address', __('所在地'));
        $show->field('capital', __('資本金'));
        $show->field('representative', __('代表者'));
        $show->field('description', __('事業内容'));
        $show->field('suppliers', __('主な取引先'));
        $show->field('suppliers_bank', __('取引銀行'));
        $show->field('history', __('会社沿革'));
        $show->field('contact', __('お問い合わせ'));
        $show->field('tel', __('電話番号'));
        $show->field('created_at', __('登録日'));
        $show->field('updated_at', __('更新日'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Company());

        $form->text('company_name', __('会社名'))->placeholder('会社名を入力してください。');
        $form->datetime('establishment_date', __('設立'))->default(function () use ($form) {
            // 初回登録時にのみデフォルト値を設定
            if (!$form->model()->establishment_date) {
                return date('Y-m-d');
            }
            // 既存の設立がある場合はその値を保持
            return $form->model()->establishment_date;
        })->format('YYYY-MM-DD');
        $form->textarea('address', __('所在地'))->placeholder('所在地を入力してください。');
        $form->text('capital', __('資本金'))->placeholder('資本金を入力してください。');
        $form->text('representative', __('代表者'))->placeholder('代表者を入力してください。');
        $form->textarea('description', __('事業内容'))->placeholder('事業内容を入力してください。');
        $form->textarea('suppliers', __('主な取引先'))->placeholder('主な取引先を入力してください。不要な場合は未入力にしてください。');
        $form->textarea('suppliers_bank', __('取引銀行'))->placeholder('取引銀行を入力してください。不要な場合は未入力にしてください。');
        $form->textarea('history', __('会社沿革'))->placeholder('会社沿革を入力してください。');
        $form->text('contact', __('お問い合わせ方法'))->placeholder('メールアドレスはエンティティ化してください。');
        $form->text('tel', __('電話番号'))->placeholder('電話番号を入力してください');

        return $form;
    }
}
