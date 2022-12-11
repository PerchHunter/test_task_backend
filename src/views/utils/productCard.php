<?php
	//админ или нет, true либо false
	$is_admin = $_COOKIE['role'] == 1;
?>

<?php foreach ($cards as $card) : ?>
	<?php
	$fullAddress = $card['address'] . " " . $card['house_number'];
	$fullAddress .= isset($card['flat_number']) ? "-$card[flat_number]" : '';
	?>

    <div class="col col-lg-3 col-sm-6 card-wrap ">
        <div class="card border-3 h-100 bg-secondary  <?php if ($is_admin && $card['status'] == 2): ?>border-warning<?php else: ?>border-light<?php endif; ?>"
             data-id="<?= $card['id'] ?>">
            <div class="product-thumb">
                <a class="d-block w-100 h-100"
                   href=" <?php if ($is_admin) echo ADMIN_PANEL_UPDATE . "&id=$card[id]";
				   else  echo SHOW_PRODUCT . "&id=$card[id]"; ?>">

                    <img class="d-block w-100 h-100"
                         src="../public/images/catalog/<?= $card['path_to_photo'] ?>"
                         alt="image">
                </a>
            </div>
            <div class="card-body">
                <a class="text-reset text-decoration-none"
                   href=" <?php if ($is_admin) echo ADMIN_PANEL_UPDATE . "&id=$card[id]";
				   else  echo SHOW_PRODUCT . "&id=$card[id]"; ?>">
                    <h4 class="card-title fw-bold text-info"><?= $card['name_of_the_object'] ?></h4>
                </a>

                <h6 class="mt-3 mb-3"><?= $fullAddress ?></h6>
                <p class="card-text"><?= $card['description'] ?></p>
                <p class="card-price mt-3"><?= $card['price'] ?> <span>руб.</span></p>

                <hr class="w-100 border-bottom border-3 border-white">
                <div class="card-body-buttons-wrapper">
                    <a class="d-block text-reset text-decoration-none mt-3"
                       href="<?= SHOW_PRODUCT . "&id=$card[id]" ?>">
                        <button type="button" class="btn btn-info">Подробнее...</button>
                    </a>
                    <a class="d-block text-reset text-decoration-none mt-3" href="#">
                        <button type="button" class="btn btn-success">Оставить заявку</button>
                    </a>
                </div>
                <hr class="w-100 border-bottom border-3 border-white">

	            <?php
		            include 'changeStatusCard.php';
	            ?>

				<?php if ($is_admin) : ?>
					<?php if ($card['status'] == 2) : ?>
                        <h5 class="fw-bold text-warning mt-2 warning-non-actually" data-id>Объявление не актуально</h5>
					<?php endif; ?>
				<?php endif; ?>

            </div>
        </div>
    </div>
<?php endforeach; ?>