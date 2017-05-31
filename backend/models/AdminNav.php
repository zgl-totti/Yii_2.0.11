<?php
namespace backend\models;

use yii\db\ActiveRecord;

class AdminNav extends ActiveRecord{
    public static function tableName(){
        return "{{%admin_nav}}";
    }

    public function rules(){

    }

    // 显示有权限的菜单
    public function getNavTree(){
        $nav=$this->where(array('pid'=>0))->order('priority')->select();
        if($nav){
            $auth=new \Think\Auth();
            foreach($nav as $k1=>$v1){
                if ($auth->check($v1['navurl'],session('aid'))) {
                    $child=$this->where(array('pid'=>$v1['id']))->order('priority')->select();
                    foreach($child as $k2=>$v2){
                        if (!$auth->check($v2['navurl'],session('aid'))) {
                            // 删除无权限的菜单
                            unset($child[$k2]);
                        }
                    }
                    $nav[$k1]['child']=$child;
                }else{
                    // 删除无权限的菜单
                    unset($nav[$k1]);
                }
            }
            return $nav;
        }else{
            return false;
        }
    }

    //设置优先级
    public function setPriority($data){
        $row=$this->save($data);
        return $row;
    }
}