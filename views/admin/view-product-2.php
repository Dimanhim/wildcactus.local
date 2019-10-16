<?php $count = 1; ?>
        <table class="table">
            <tr class="header_tr">
                <td>№</td>
                <td>Название</td>
                <td>Цена</td>
            </tr>
            <?php foreach($product as $prod) { ?>
                <tr>
                    <td><?=$count?></td>
                    <td><a href="<?= Yii::$app->urlManager->createUrl(['admin/product', 'id' => $prod->id]) ?>"><?=$prod->name?></a></td>
                    <td><?=$prod->price?></td>
                </tr>
                <?php $count++ ?>
            <?php } ?>
        </table>

