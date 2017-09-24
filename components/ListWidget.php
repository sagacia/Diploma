<?php

namespace app\components;
use yii\base\Widget;
use app\models\Category;
use Yii;

class MenuWidget extends Widget {
    
    public $tpl;
    public $model;
    public $data;
    public $tree;
    public $menuHtml;    
    
    public function init(){
        parent::init();
        if($this->tpl===null)        {
            $this->tpl = 'listcheckbox';
        }
        $this->tpl .= '.php';
    }
    
    public function run(){
        

        $this->menuHtml = $this->getMenuHtml($this->model); 
        
        return $this->menuHtml;
    }
    
    protected function getTree(){
        $tree = [];
        foreach ($this->data as $id =>&$node) {
            if(!$node['parent_id'])
                $tree[$id]=&$node;
            else
                $this->data[$node['parent_id']]['childs'][$node['cat_id']]=&$node;            
        }
        return $tree;        
    }
    
    protected function getMenuHtml($model){
        $str='';
            foreach ($model as $item) {
                $str .= $this->catToTemplate($item); 
            }   
       // echo "вывод ".$str . "<br>";
      // debug($str);
        return $str;
    }
    
    protected function catToTemplate($item){
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }
}
