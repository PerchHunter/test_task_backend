<?php
    include_once '../configurations/routes.php';
?>

<div class="container-lg">
    <p class="h3 text-light">Регистрация</p>
    <form action="#" method="post" id="form-registration">
        <div class="mb-3 ">
            <label for="inputName" class="col-sm-2 col-form-label">Имя</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="inputName" name="name" required>
            </div>
        </div>
        <div class="mb-3 ">
            <label for="inputSurname" class="col-sm-2 col-form-label">Фамилия</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="inputSurname" name="surname" required>
            </div>
        </div>
        <div class="mb-3 ">
            <label for="inputLogin" class="col-sm-2 col-form-label">Login</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="inputLogin" name="login" required>
            </div>
        </div>
        <div class="mb-3 ">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="inputEmail" name="email" required>
            </div>
        </div>
        <div class="mb-3 ">
            <label for="inputPassword" class="col-sm-2 col-form-label">Пароль</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" id="inputPassword" name="password" required>
            </div>
        </div>
        <button type="submit" id="btn-registration" class="btn btn-light" form="form-registration">Зарегистрироваться</button>
    </form>
	<?php if (!empty($errorMessage)) :?>
        <p class="text-danger mt-3"><?= $errorMessage ?></p>
	<?php endif; ?>

	<?php if (!empty($successMessage)) :?>
        <p class="text-success mt-3"><?= $successMessage ?></p>
        <a href="<?= AUTHORIZATION ?>"><button type="button" class="btn btn-success ms-auto ">Авторизуйтесь!</button></a>
	<?php endif;?>
    </div>




<!--<div class="container">-->
<!--	<div class="registration_box">-->
<!--		<h3>Форма регистрации</h3>-->
<!--		<form id="form_registration" action="#" method="post" enctype="application/x-www-form-urlencoded">-->
<!--			<input type="text" name="name" placeholder="Ваше имя" required>-->
<!--			<input type="text" name="surname" placeholder="Фамилия" required>-->
<!--			<input type="text" name="country" placeholder="Страна">-->
<!--			<input type="text" name="city" placeholder="Город">-->
<!--			<input type="email" name="email" placeholder="Email" required>-->
<!--			<input type="password" name="password" placeholder="Пароль" required>-->
<!--			<input type="tel" name="telephone" placeholder="Телефон" >-->
<!--			<button class="button" type="submit">Зарегистрироваться!</button>-->
<!--		</form>-->
<!--        <p>--><?//=$message?><!--</p>-->
<!--	</div>-->
<!--    <p>Уже зарегистрированы? <a href="index.php?c=user&act=auth">Войдите!</a></p>-->
<!--</div>-->
