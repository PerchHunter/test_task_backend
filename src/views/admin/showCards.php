<?php
	include_once '../configurations/routes.php';
?>

<div class="container">

	<?php
		require_once '../views/utils/sortingByPrice.php';
	?>

    <div class="row row-cols-1 row-cols-md-3 g-4 " id="cards-wrapper-EVENT">

		<?php
			require_once '../views/utils/productCard.php';
		?>

		<?php if ($cards['errorMessage']): ?>
            <p class="text-success mt-3 success-message"><?= $cards['errorMessage'] ?></p>
		<?php endif; ?>
    </div>
</div>


