<div class="select_date">
			<h2><?= $message ?> <b>(<?=$countOrders?>)</b></h2>
			<form action="" method="post">
				С
				<select name="from_day">
					<?php for($i = 1; $i < 32; $i++) { ?>
					<option <?php if($i == $date['fromDay']) { ?>selected<?php } ?>><?= $i ?></option>
					<?php } ?>
				</select>
				<select name="from_month">
					<?php for($i = 1; $i < 13; $i++) { ?>
					<option <?php if($i == $date['fromMonth']) { ?>selected<?php } ?>><?= $i ?></option>
					<?php } ?>
				</select>
				<select name="from_year">
					<?php for($i = $date['minYear']; $i < $date['maxYear'] + 1; $i++) { ?>
					<option <?php if($i == $date['fromYear']) { ?>selected<?php } ?>><?= $i ?></option>
					<?php } ?>
				</select>
				По
				<select name="to_day">
					<?php for($i = 1; $i < 32; $i++) { ?>
					<option <?php if($i == $date['toDay']) { ?>selected<?php } ?>><?= $i ?></option>
					<?php } ?>
				</select>
				<select name="to_month">
					<?php for($i = 1; $i < 13; $i++) { ?>
					<option <?php if($i == $date['toMonth']) { ?>selected<?php } ?>><?= $i ?></option>
					<?php } ?>
				</select>
				<select name="to_year">
					<?php for($i = $date['minYear']; $i < $date['maxYear'] + 1; $i++) { ?>
					<option <?php if($i == $date['toYear']) { ?>selected<?php } ?>><?= $i ?></option>
					<?php } ?>
				</select>
				<button name="change_date" value="true">Показать</button>
				<button name="drop_date" value="true" class="drop_date" style="margin-left: 100px; font-size: 12px;">Сбросить даты</button>
			</form>
		</div>