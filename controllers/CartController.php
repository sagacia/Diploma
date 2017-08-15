<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;
use app\models\Order;
use \app\models\OrderItems;
use Yii;

class CartController extends AppController {
    /* добавить позицию в корзину */

    public function actionAdd() {
        $id = Yii::$app->request->get('id');
        $qty = (int) Yii::$app->request->get('qty');
        $qty = !$qty ? 1 : $qty;
        $product = Product::findOne($id);
        if (empty($product))
            return;
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        /* если у пользователя отключен js, не показывает корзину, а redirect на ту же страницу */
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    /* очистить корзину */

    public function actionClear() {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    /* удаление позиции из корзины и пересчет корзины */

    public function actionDelItemModal() {
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    /* показ корзины в немодальном окне */

    public function actionShowcart() {
        $session = Yii::$app->session;
        $session->open();
        return $this->render('cart-modal', compact('session'));
    }

    public function actionGetcartmodal() {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }

    /* просмотр корзины */

    public function actionView() {
        $session = Yii::$app->session;
        $session->open();
        $this->setMeta('Корзина');
        $order = new Order();
        if ($order->load(Yii::$app->request->post())) {
            //debug(Yii::$app->request->post());
            $order->qty = $session['cart.qty'];
            $order->sum = $session['cart.sum'];
            if ($order->save()) {
                $this->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('successOrder', 'Ваш заказ принят');
                Yii::$app->mailer->compose('order', compact('session'))
                        ->setFrom(['test@mail.tt'=>'автоматическая отправка'])
                        ->setTo($order->email) //продублировать для администратора Yii::$app->params['adminEmail']
                        ->setSubject('Заказ товара')
                        ->send();
                
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('errorOrder', 'Ошибка оформления заказа');
            }
        }
        return $this->render('view', compact('session', 'order'));
    }

    public function saveOrderItems($items, $order_id) {
        foreach ($items as $id => $item) {
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->product_name = $item['name'];
            $order_items->price = (int) $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['qty'] * (int) $item['price'];
            $order_items->save();
        }
    }

}
