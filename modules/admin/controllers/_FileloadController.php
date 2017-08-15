<?php

namespace app\modules\admin\controllers;

use app\modules\admin\models\UploadForm;
use app\modules\admin\models\Category;
use yii\web\Controller;
use Yii;

class FileloadController extends AppAdminController {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex() {
        $model = new UploadForm();

        //debug($_FILES['UploadForm']['tmp_name']['file']);
        $handle = @fopen($_FILES['UploadForm']['tmp_name']['file'], "r");

       // debug($_FILES);
        if ($handle) {
            $res = true;
            $buffer = fgets($handle);
            
            while ($res) {

                $res = $buffer = fgets($handle);
                if (empty($res)) {
                    break;
                } else {
                    debug($res);
                    $row = explode("\t", $buffer);
                    $category = new Category();
                    $category->cat_id = $row[0];
                    $category->parent = $row[1];
                    $category->cat_name = $row[2];
                    $category->cat_description = $row[3] == "NULL" ? NULL : $row[3];
                    $category->save();
                }
            }
            if (!feof($handle)) {
                echo "Error: пустой файл\n";
            }
            fclose($handle);
        }
        return $this->render('index', compact('model'));
    }

}
