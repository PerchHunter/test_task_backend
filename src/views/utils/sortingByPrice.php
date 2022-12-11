<?php
	$controller = $_GET['c'] === 'admin' ? 'admin' : 'page';
?>

<div class="mb-3 w-100 ">
	<div class="col-sm-4 ms-auto">
		<select class="form-select" role="button" id="sorting-by-price-select-EVENT"  aria-label=".form-select-sm example"
		data-cont="<?= $controller ?>">
			<option disabled selected value="">Сортировать по...</option>
			<option value="ASC">Возрастанию цены (по умолчанию)</option>
			<option value="DESC">Убыванию цены</option>
		</select>
	</div>
</div>