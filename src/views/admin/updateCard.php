
<div class="container-lg">
	<p class="h3 text-light">Страница обновления информации в объявлении "<?= $cardData['name_of_the_object'] ?>" , id # <?= $cardData['id'] ?></p>
	<form class="row g-3" action="#"  id="update-object-form" name="updateObjectForm">
		<div class="col-md-6 mb-3">
			<label for="inputName" class="form-label">Наименование объекта</label>
			<input type="text" class="form-control" id="inputName" required name="nameOfObject" value="<?= $cardData['name_of_the_object'] ?>">
		</div>
		<div class="col-md-6 mb-3">
			<label for="inputFile" class="form-label">Фотографии</label>
			<input type="file" class="form-control" aria-label="file example" id="inputFile" name="photos" multiple accept="image/*" disabled value="<?= $cardData['path_to_photo'] ?>">
		</div>
		<div class="col-12 mb-3">
			<label for="inputStreet" class="form-label">Улица</label>
			<input type="text" class="form-control" id="inputStreet" required name="street" value="<?= $cardData['address'] ?>">
		</div>
		<div class="col-12 mb-3">
			<label for="inputHouseNumber" class="form-label">Номер дома</label>
			<input type="text" class="form-control" id="inputHouseNumber" required name="houseNumber" value="<?= $cardData['house_number'] ?>">
		</div>
		<div class="col-12 mb-3">
			<label for="inputFlatNumber" class="form-label">Номер квартиры</label>
			<input type="number" class="form-control" id="inputFlatNumber" required name="flatNumber" placeholder="Если номера квартиры нет, напишите 0" value="<?= $cardData['flat_number'] ?>">
		</div>
		<div class="col-12 mb-3">
			<label for="inputDescription" class="form-label">Описание</label>
			<textarea class="form-control" id="inputDescription" required name="description" ><?= $cardData['description']?></textarea>
		</div>

		<div class="col-md-2 mb-3">
			<label for="inputPrice" class="form-label">Цена</label>
			<input type="number" class="form-control" id="inputPrice" required name="price" value="<?= $cardData['price']?>">
		</div>
		<div class="col-md-3">
			<label for="selectStatus" class="form-label">Статус</label>
			<select class="form-select" id="selectStatus" required name="status">
				<option selected disabled value="<?= $cardData['status']?>"><?= $cardData['status']?></option>
				<option value="1">Актуально</option>
				<option value="2">Не актуально</option>
			</select>
		</div>

        <div class="update-card-buttons-wrapper w-100">
            <div class="col-4 mb-3">
                <button type="submit" class="btn btn-primary" form="update-object-form" name="id" value="<?= $cardData['id']?>">Сохранить изменения</button>
            </div>

            <div class="col-4 mb-3">
                <button type="reset" class="btn btn-primary" form="update-object-form">Сбросить поля</button>
            </div>

            <div class="col-4 mb-3">
                <button type="button" class="btn btn-primary" form="update-object-form">Удалить объявление</button>
            </div>
        </div>
	</form>
</div>
