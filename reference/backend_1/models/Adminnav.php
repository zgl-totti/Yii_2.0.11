<?php
namespace backend\models;

use yii\base\Model;
use yii\db\Query;

class Adminnav extends Model{
    public function addNav($data){
        \Yii::$app->db->createCommand()->insert('mj_admin_nav',$data)->execute();
        $nid=\Yii::$app->db->getLastInsertID();
        if($nid){
            if($data['pid']==0){
                $path=$nid;
            }else{
                $whrer['id']=$data['pid'];
                $path=(new Query())->select('path')->where($whrer)->one();
                $path.=','.$nid;
            }
            $save['path']=$path;
            $save['id']=$nid;
            $row=\Yii::$app->db->createCommand()->update('mj_admin_nav',$save)->execute();
            return $row;
        }else{
            return $nid;
        }
    }

    public function getOne($where){
        $info=(new Query())->select('*')->from('mj_admin_nav')->where($where)->one();
        return $info;
    }

    public function del($where){
        $row=\Yii::$app->db->createCommand()->delete('mj_admin_nav',$where)->execute();
        return $row;
    }

    public function num($where=''){
        $count=(new Query())->select('id')->from('mj_admin_nav')->where($where)->count();
        return $count;
    }

    public function getList($where='',$pages){
        $list=(new Query())->select('*')->from('mj_admin_nav')
            ->where($where)
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $list;
    }

    public function update($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_admin_nav',$where,$data)->execute();
        return $row;
    }

    public function getNavList(){
        $navList=(new Query())->select('*')->from('mj_admin_nav')->orderBy('priority','asc')->all();
        foreach($navList as $k=>$v){
            $count=count(explode(',',$v['path']));
            $navList[$k]['level']=$count;
        }
        return $navList;
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

    public function setPriority($where,$data){
        $row=\Yii::$app->db->createCommand()->update('mj_admin_nav',$where,$data)->execute();
        return $row;
    }

    public function getNavInfo($id){
        $where['id']=$id;
        $res=(new Query())->select('*')->from('mj_admin_nav')->where($where)->one();
        if($res['pid']>0){
            $condition['id']=$res['pid'];
            $info=(new Query())->select('*')->where($condition)->one();
            $res['pname']=$info['navname'];
        }else{
            $res['pname']=$res['navname'];
        }
        return $res;
    }
}