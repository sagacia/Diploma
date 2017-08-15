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
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }
    
    public function run(){
        //get cache
        if($this->tpl=='menu.php')
        {
            $menu = Yii::$app->cache->get('menu');
            if($menu) return $menu;       
        }
        $this->data = Category::find()->indexBy('cat_id')->asArray()->all();
        //debug($this->data);
        $this->tree = $this->getTree();
        //debug($this->tree);

        $this->menuHtml = $this->getMenuHtml($this->tree); //debug($this->tree); // debug($this->data);
        //set cache
                if($this->tpl=='menu.php'){
                    Yii::$app->cache->set('menu', $this->menuHtml, 60);
                }
        
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
    
    protected function getMenuHtml($tree, $tab=''){
        $str='';
        if (!empty($tree) && is_array($tree)) {
            foreach ($tree as $category) {
                $str .= $this->catToTemplate($category, $tab); 
            }   
        }
       // echo "вывод ".$str . "<br>";
      // debug($str);
        return $str;
    }
    
    protected function catToTemplate($category, $tab){
        ob_start();
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        return ob_get_clean();
    }
}
