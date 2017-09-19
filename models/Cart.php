<?php

namespace app\models;

use yii\base\Model;

class Cart extends \yii\db\ActiveRecord {

    public function behaviors() {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    public function addToCart($product, $qty = 1) {
        $mainImg = $product->getImage();
       // debug($mainImg->$getUrl);die;
       // return;
        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty']+=$qty;
        } else {
            $_SESSION['cart'][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $mainImg->getUrl('x50')
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty']+= $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum']+= $qty * $product->price :
                $qty * $product->price;
        // unset($_SESSION['cart']);
        //session_destroy();
    }

    public function recalc($id) {
        if (!isset($_SESSION['cart'][$id])) {
            // echo $_SESSION['cart'][$id];
            return false;
        }
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        $_SESSION['cart.qty']-=$qtyMinus;
        $_SESSION['cart.qty']-=$sumMinus;
        unset($_SESSION['cart'][$id]);
        //debug($_SESSION);
    }

}
