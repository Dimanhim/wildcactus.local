          <ul class="nav-ul">
            <li><a href="/">Главная</a></li>
      <!-- Несколько позиций в меню -->
        <?php $cats = $functions->getLevelCat(4) ?>
        <?php foreach($cats as $cat) { ?>
            <li><a href="<?= Yii::$app->urlManager->createUrl(['site/category', 'id' => $cat->id]) ?>"><?= $cat->name ?></a></li>
        <?php } ?>

      <!-- Меню каталога -->
        <?php $cats = $functions->getAllCats() ?>
            <li>
               <a href="#" style="pointer-events: none;">Каталог</a>
               <div class="sub-nav">
                  <ul>
                  <?php foreach($cats as $cat) { ?>
                    <?php $subcats = $functions->getSubCats($cat->id) ?>
                     <li>
                        <a href="<?= Yii::$app->urlManager->createUrl(['site/category', 'id' => $cat->id]) ?>"><?= $cat->name ?></a>
                        <?php if($subcats) { ?>
                        <ul>
                          <?php foreach($subcats as $subcat) { ?>
                          <li><a href="<?= Yii::$app->urlManager->createUrl(['site/category', 'id' => $subcat->id]) ?>"><?= $subcat->name ?></a></li>
                          <?php } ?>
                        </ul>
                      <?php } ?>
                     </li>
                  <?php } ?>
                  </ul>
               </div>
            </li>
         </ul>