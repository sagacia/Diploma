<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

//use yii\widgets\DetailView;
//$this->title = $model->email;
//$this->params['breadcrumbs'][] = ['label' => 'Dws', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">


    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm8">
            <div class="result">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th> Сегмент</th>
                            <th> Количество клиентов </th>
                            <th> Доля  в общей базе </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $sum = 0; ?>
                        <?php foreach ($query as $seg): ?>
                        <?php $sum+=$seg['cnt']; ?>
                        <tr>
                            <td><input type="checkbox" name="news" class="segment" 
                                       data-segr='<?= $seg['segment'] ?>' >
                                <?= $seg['segment'] ?></td>
                            <td><?= $seg['cnt'] ?></td>
                            <td><?= round($seg['cnt'] / $totalemails, 2) ?>%</td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="total">
                            <td>Итого</td>
                            <td><?= $sum ?></td>
                            <td><?= round($sum / $totalemails, 2) ?>%</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2">
            <div class="emails">Emails
                <?php foreach ($emails as $email): ?>
                <div>
                    <input type="checkbox" name="news" value="ON" class="email"
                           data-email='<?= $email['email'] ?>' 
                           data-segemail="<?= $email['segment'] ?>">
                           <?= $email['email'] ?>
                </div>
                <?php endforeach; ?>

            </div>
        </div>

        <div class=" col-lg-2 col-md-2 col-sm-2 proposal">
            <select>
                <?php foreach ($proposals as $proposal): ?>
                <option value="<?= $proposal->id ?>" >
                   
                    <?= $proposal->title ?> </option>
                    <?php endforeach; ?>

            </select>
        </div>
        <div class="container"><a class="btn btn-warning sendemails" href="<?= \yii\helpers\Url::to(['/crm/dw/sendemails']) ?>" class="active">Отправить предложение</a></div>


    </div>
</div>