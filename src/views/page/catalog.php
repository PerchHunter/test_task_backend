<?php
	include_once '../configurations/routes.php';
?>

<div class="container">
    <p class="h3 text-light">Каталог</p>

	<?php
		require_once '../views/utils/sortingByPrice.php';
	?>

    <div class="row row-cols-1 row-cols-md-3 g-4" id="cards-wrapper-EVENT">

		<?php
			require_once '../views/utils/productCard.php';
		?>

        <!--        1 - админ-->
		<?php if ($cards['errorMessage'])
			if ($_COOKIE['role'] == 1) :?>
                <p class="text-success mt-3 success-message"><?= $cards['errorMessage'] ?></p>
			<?php else : ?>
                <p class="text-success mt-3 success-message">Произошла неожиданная ошибка при загрузке данных</p>
			<?php endif; ?>
    </div>
</div>


