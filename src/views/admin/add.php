<div class="container-lg">
    <p class="h3 text-light">Добавить объект недвижимости</p>
    <form class="row g-3" action="#"  id="add-new-object-form" name="addNewObjectForm">
        <div class="col-md-6 mb-3">
            <label for="inputName" class="form-label">Наименование объекта</label>
            <input type="text" class="form-control" id="inputName" required name="nameOfObject">
        </div>
        <div class="col-md-6 mb-3">
            <label for="inputFile" class="form-label">Фотографии</label>
            <input type="file" class="form-control" aria-label="file example" id="inputFile" name="photos" multiple accept="image/*" disabled>
        </div>
        <div class="col-12 mb-3">
            <label for="inputStreet" class="form-label">Улица</label>
            <input type="text" class="form-control" id="inputStreet" required name="street">
        </div>
        <div class="col-12 mb-3">
            <label for="inputHouseNumber" class="form-label">Номер дома</label>
            <input type="text" class="form-control" id="inputHouseNumber" required name="houseNumber">
        </div>
        <div class="col-12 mb-3">
            <label for="inputFlatNumber" class="form-label">Номер квартиры</label>
            <input type="number" class="form-control" id="inputFlatNumber" required name="flatNumber" placeholder="Если номера квартиры нет, напишите 0">
        </div>
        <div class="col-12 mb-3">
            <label for="inputDescription" class="form-label">Описание</label>
            <textarea class="form-control" id="inputDescription" required name="description"></textarea>
        </div>

        <div class="col-md-2 mb-3">
            <label for="inputPrice" class="form-label">Цена</label>
            <input type="number" class="form-control" id="inputPrice" required name="price">
        </div>
        <div class="col-md-3">
            <label for="selectStatus" class="form-label">Статус</label>
            <select class="form-select" id="selectStatus" required name="status">
                <option selected disabled value="">Выберите...</option>
                <option value="1">Актуально</option>
                <option value="2">Не актуально</option>
            </select>
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary" form="add-new-object-form">Добавить</button>
        </div>
    </form>
</div>