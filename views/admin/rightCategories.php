					<div class="col-md-3">
						<div class="block_info">
							<h4>Древо категорий</h4>
							<ul class="right-categories">
							<?php foreach($categories as $categor) { ?>
								<?php if($categor->level != 2) { ?>
								<li>
									<a href="<?= Yii::$app->urlManager->createUrl(['admin/category', 'id' => $categor->id]) ?>">
										<!--<img src="<?php // PATH.$categor->img ?>" alt="" style="width: 30px" />--><?= $categor->name ?>
									</a>
									
									<ul>
										<?php foreach($categories as $cat) { ?>
											<?php if(($cat->level == 2) && ($cat->parent == $categor->id)) { ?>
												<li>
													<a href="<?= Yii::$app->urlManager->createUrl(['admin/category', 'id' => $cat->id]) ?>">
														<!--<img src="<?php // PATH.$cat->img ?>" alt="" style="width: 30px" />--><?= $cat->name ?>
													</a>
													
												</li>
											<?php } ?>
										<?php } ?>	
									</ul>
								</li>
								<?php } ?>
							<?php } ?>
							</ul>	
						</div>
					</div>