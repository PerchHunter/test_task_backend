<?php
	include_once '../configurations/routes.php';
?>

<div class="container-lg">
    <p class="h3 text-light">Авторизация</p>
    <form action="#" method="post" id="form-auth">
        <div class="mb-3 ">
            <label for="inputLogin" class="col-sm-2 col-form-label">Логин</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="inputLogin" name="login">
            </div>
        </div>
        <div class="mb-3 ">
            <label for="inputPassword" class="col-sm-2 col-form-label">Пароль</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" id="inputPassword" name="password">
            </div>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="rememberMe">
            <label class="form-check-label" for="flexCheckDefault">
                Запомнить меня
            </label>
        </div>
        <button type="submit" id="btn-auth" class="btn btn-light" form="form-auth">Войти</button>
    </form>
	<?php if (!empty($errorMessage)) : ?>
        <p class="text-danger mt-3"><?= $errorMessage ?></p>
	<?php endif; ?>
</div>