<?php
	include_once '../configurations/routes.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="../public/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="../public/scss/custom-styles.css" rel="stylesheet"
          crossorigin="anonymous">

    <title><?= $title ?></title>
</head>
<body class="bg-dark text-white">
<header class="header border-bottom border-3 border-secondary">
    <div class="container-xxl">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark border-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?= HOMEPAGE ?>">
                    <img class="header-logo" src="../public/images/logo.png"
                         alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= HOMEPAGE ?>">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= CATALOG ?>">Каталог</a>
                        </li>

<!--                   1 - админ-->
						<?php if ($_COOKIE['role'] === '1') : ?>
                        <li class="nav-item dropdown admin-panel">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                               aria-expanded="false">
                                Админка
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= ADMIN_PANEL_SHOW_CARDS ?>">Просмотреть все объекты</a></li>
                                <li><a class="dropdown-item" href="<?= ADMIN_PANEL_ADD ?>">Добавить</a></li>
                            </ul>
                        </li>
					<?php endif; ?>

                    </ul>

                    <div class="input-group w-50">
                            <select class="btn btn-success dropdown-toggle w-70" role="button" id="variant-search-select"  aria-label=".form-select-sm example">
                                <option disabled selected value="">Поиск по...</option>
                                <option value="houseNumber">Номеру дома</option>
                            </select>

                        <input class="form-control" id="input-search" type="search" aria-label="Search">
                        <button class="btn btn-success" type="button" id="search-button-EVENT">Искать</button>
                    </div>


                    <?php
						if (!empty($_COOKIE['auth'])) :?>
                            <button type="button" id="btn-unauth-EVENT" class="btn btn-light ms-auto ">Выйти</button>
						<?php else: ?>
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                       aria-expanded="false">
                                        Личный кабинет
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?= AUTHORIZATION ?>">Войти</a></li>
                                        <li><a class="dropdown-item" href="<?= REGISTRATION ?>">Зарегистрироваться</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
						<?php endif; ?>
                </div>
            </div>
        </nav>
    </div>
</header>

<main class="pt-3">
		<?= $content ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

<script defer src="../public/js/events.js"></script>
</body>
</html>