<?php
	include_once '../configurations/routes.php';

	$fullAddress = $card['address'] . " " . $card['house_number'];
	$fullAddress .= isset($card['flat_number']) ? "-$card[flat_number]" : '';
?>

<div class="container-fluid my-carousel">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../public/images/catalog/default.png" class="d-block w-100" alt="photo">
            </div>
            <div class="carousel-item">
                <img src="../public/images/catalog/default.png" class="d-block w-100" alt="photo">
            </div>
            <div class="carousel-item">
                <img src="../public/images/catalog/default.png" class="d-block w-100" alt="photo">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Назад</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Далее</span>
        </button>
    </div>
</div>

<div class="col col-lg-8 col-sm-12 pt-5 m-auto">
    <div class="container-sm">
        <div class="card bg-secondary">
            <div class="card-body w-100 m-auto">
                <h3 class="card-title fw-bold"><?= $card['name_of_the_object'] ?></h3>
                <p class="card-text">Адрес: <?= $fullAddress ?></p>
                <p class="card-text">Описание: <?= $card['description'] ?></p>
                <p class="card-text">Цена: <?= $card['price'] ?> рублей</p>
                <div class="card-body-buttons-wrapper">
                    <a class="d-block text-reset text-decoration-none mt-3"
                       href="<?= $_SERVER['HTTP_REFERER'] ?>">
                        <button type="button" class="btn btn-info">Назад</button>
                    </a>
                    <a class="d-block text-reset text-decoration-none mt-3" href="#">
                        <button type="button" class="btn btn-success">Оставить заявку</button>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>