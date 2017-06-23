<?php
/**
 * Formvalidation_Regist
 *
 * バリデーションのルール 登録用
 *
 * @author Masanori Oobayashi
 */
namespace Formvalidation;

class Enquete
{

    public static function send()
    {
        // フォームの設定
        $val = \Validation::forge('enquete');

        $val->add('best', __('common.best'))
            ->add_rule('trim')
            ->add_rule('required')
            ->add_rule('min_length', 1)
            ->add_rule('max_length', 2)
            ->add_rule('valid_string', ['numeric']);

        $val->add('name', __('common.name'))
            ->add_rule('trim')
            ->add_rule('required')
            ->add_rule('max_length', 20);

        $val->add('remarks', __('common.remarks'))
            ->add_rule('trim')
            ->add_rule('max_length', 2000);

        return $val;
    }

}
