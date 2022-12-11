/*
* Файл с обработчиками событий и  ajax - запросами
*  */

//выход из профиля пользователя
const unAuthButton = document.getElementById('btn-unauth-EVENT');
if (unAuthButton) {
    unAuthButton.addEventListener('click', (e) => {
        const is_admin = getCookie('role') === '1';
        document.cookie = "auth=true; max-age=0";
        document.cookie = "role=0; max-age=0";

        if (is_admin) {
            //удаляю админку из DOM
            const adminPanel = document.querySelector('.admin-panel');
            adminPanel.remove();
        }
        const  AUTHORIZATION = getRoute('AUTHORIZATION');
        const  REGISTRATION = getRoute('REGISTRATION');

        // заменяю кнопку "Выйти" на выпадающее меню
        e.target.outerHTML = `<ul class="navbar-nav ms-auto mb-2 mb-lg-0"><li class="nav-item dropdown">` +
            `<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"aria-expanded="false">Личный кабинет</a>` +
            `<ul class="dropdown-menu"><li><a class="dropdown-item" href="${AUTHORIZATION}">Войти</a></li>` +
            `<li><a class="dropdown-item" href="${REGISTRATION}">Зарегистрироваться</a></li></ul></li></ul>`;
    })
}


// форма отправки данных, когда добавляем новый объект недвижимости в админке
//нашхожу форму в DOM по её атрибуту "name"
const addNewObjectForm = document.forms.addNewObjectForm;
if (addNewObjectForm) {
    addNewObjectForm.addEventListener('submit', (e) => {
        e.preventDefault();

        //пытался отправлять данные и файлы с помощью FormData, но почему-то в php не мог их получить.

        // массивы $_POST и $_FILE были пустыми. Причину не нашёл, пришлось отправлять данные по-другому

        // const formData = new FormData(e.target);
        // const headers = {
        //     "Content-Type": "multipart/form-data",
        // }
        //
        // fetch('../lib/server.php', {method: "POST", body: formData, headers})

        //достал input'ы по их атрибутам "name"
        const {nameOfObject, street, houseNumber, flatNumber, description, price, status} = e.target;

        const string = `model=admin&action=add&nameOfObject=${nameOfObject.value}&street=${street.value}&houseNumber=${houseNumber.value}&flatNumber=${flatNumber.value}&description=${description.value}&price=${price.value}&status=${status.value}`;
        const headers = {
            "Content-Type": "application/x-www-form-urlencoded",
        }

        fetch('../lib/server.php', {method: "POST", body: string, headers})
            .then(response => {
                return response.status !== 200 ? Promise.reject() : response.json();
            })
            .then(result => {
                let illuminationTime, messageElem;


                if (result.successMessage) {
                    // в случае успеха, высвечиваем уведомление и время его подсветки
                    messageElem = `<p class=\"text-success mt-3 success-message\">${result.successMessage}</p>`;
                    illuminationTime = 4000;
                }

                if (result.errorMessage) {
                    // аналогично, только с ошибкой.
                    messageElem = `<p class=\"text-danger mt-3 error-message\">${result.errorMessage}</p>`;
                    illuminationTime = 10000;
                }

                e.target.insertAdjacentHTML("afterend", messageElem);
                setTimeout(() => e.target.nextElementSibling.remove(), illuminationTime);
            })
    })
}

// сортировка по убыванию/возрастанию цены
const sortingByPriceSelect = document.getElementById('sorting-by-price-select-EVENT');
if (sortingByPriceSelect) {
    sortingByPriceSelect.addEventListener('change', (e) => {
        const sortParameter = e.target.value; // ASC | DESC
        const currController = e.target.dataset.cont; // page | admin

        fetch(`../lib/server.php?model=${currController}&action=sorting`)
            .then(response => {
                return response.status !== 200 ? Promise.reject() : response.json();
            })
            .then(result => createProductCards([result, sortParameter]))
    })
}

// обновление статуса карточки в админке
const cardsWrapper = document.getElementById('cards-wrapper-EVENT');
if (cardsWrapper) {
    cardsWrapper.addEventListener('change', (e) => {
        if (!cardsWrapper.contains(e.target)) return;
        const newStatus = e.target.value;
        const idCard = e.target.dataset.id;

        const body = JSON.stringify({
            'newStatus': newStatus,
            'idCard': idCard,
            'action': e.target.dataset.action,
        });
        const headers = {
            'Content-type': 'application/json; charset=UTF-8',
        };

        fetch(`../lib/server.php?model=admin&action=updateStatusCard`, {method: 'PATCH', body, headers})
            .then(response => {
                return response.status !== 200 ? Promise.reject() : response.json();
            })
            .then(result => {
                const cardBody = cardsWrapper.querySelector(`.card[data-id="${idCard}"] .card-body`);
                const warnMsg = cardBody.querySelector('.warning-non-actually');
                let html = `<h5 className="fw-bold text-warning mt-2 warning-non-actually" data-id>`;

                if (result.statusCard === '2') {
                    html += `Объявление не актуально</h5>`;
                    cardBody.insertAdjacentHTML('beforeend', html);
                } else if (newStatus === '1' && warnMsg) {
                    warnMsg.remove();
                }
            })
    })
}


// обновление всей информации в статусе товара
const updateObjectForm = document.forms.updateObjectForm;
if (updateObjectForm) {
    updateObjectForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const body = JSON.stringify({
            id: e.target.id.value,
            nameOfObject: e.target.nameOfObject.value,
            photos: e.target.photos.value,
            street: e.target.street.value,
            houseNumber: e.target.houseNumber.value,
            flatNumber: e.target.flatNumber.value,
            description: e.target.description.value,
            price: e.target.price.value,
            status: e.target.status.value,
        });
        const headers = {
            'Content-type': 'application/json; charset=UTF-8',
        };

        fetch(`../lib/server.php?model=admin&action=updateAllDataInCard&id=${e.target.id}`, {
            method: 'PATCH',
            body,
            headers
        })
            .then(response => {
                return response.status !== 200 ? Promise.reject() : response.json();
            })
            .then(result => {
                let illuminationTime, messageElem;

                if (result.successMessage) {
                    // в случае успеха, высвечиваем уведомление и время его подсветки
                    messageElem = `<p class=\"text-success mt-3 success-message\">${result.successMessage}</p>`;
                    illuminationTime = 4000;
                }

                if (result.errorMessage) {
                    messageElem = `<p class=\"text-danger mt-3 error-message\">${result.errorMessage}</p>`;
                    illuminationTime = 10000;
                }

                e.target.insertAdjacentHTML("afterend", messageElem);
                setTimeout(() => e.target.nextElementSibling.remove(), illuminationTime);
            })
    })
}


// Поле поиска. Реализован только поиск по номеру дома
const searchButton = document.getElementById('search-button-EVENT');
if (searchButton) {
    searchButton.addEventListener('click', (e) => {
        const variantSearch = document.getElementById('variant-search-select').value;
        const textSearch = document.getElementById('input-search').value;

        if (!variantSearch || !textSearch) return;

        fetch(`../lib/server.php?model=page&action=search&variantSearch=${variantSearch}&textSearch=${textSearch}`)
            .then(response => {
                return response.status !== 200 ? Promise.reject() : response.json()
            })
            .then(result => createProductCards([result]))
    })
}

const getRoute = (nameRoute) => {
    switch (nameRoute) {
        case 'SHOW_PRODUCT':
            return 'index.php?c=page&act=showone';
        case 'ADMIN_PANEL_UPDATE':
            return 'index.php?c=admin&act=update';
        case 'AUTHORIZATION':
            return 'index.php?c=user&act=auth';
        case 'REGISTRATION':
            return 'index.php?c=user&act=registration';
        default:
            return null;
    }
};

const getCookie = (nameCookie) => {
    const arrCookie = document.cookie.split(';')

    for (let oneCookie of arrCookie) {
        const oneCookieArr = oneCookie.split('=');

        if (oneCookieArr[0].trim() === nameCookie) {
            return oneCookieArr[1];
        }
    }
};

const createProductCards = ([arrayCards, sortParameter = '']) => {
    const cardsWrapper = document.getElementById('cards-wrapper-EVENT');
    // очистили блок от старых карточек
    cardsWrapper.innerHTML = '';

    const is_admin = getCookie('role') === '1'; 	//админ или нет, true либо false
    const SHOW_PRODUCT = getRoute('SHOW_PRODUCT');
    const ADMIN_PANEL_UPDATE = getRoute('ADMIN_PANEL_UPDATE');

    // arrayCards - массив с объектами карточек. По очереди вставляю карточки в блок cards-wrapper
    for (let card of arrayCards) {
        const cardBorderClass = (is_admin && card.status === '2') ? 'border-warning' : 'border-light';
        const linkToProductPage = is_admin ? `${ADMIN_PANEL_UPDATE}&id=${card.id}` : `${SHOW_PRODUCT}&id=${card.id}`;
        let fullAddress = `${card.address} ${card.house_number}`;
        fullAddress += card.flat_number ? `-${card.flat_number}` : '';

        // html - код карточки товара
        let htmlCard = `<div class="col col-lg-3 col-sm-6 card-wrap">` +
            `<div class="card border-3 h-100 bg-secondary ${cardBorderClass}" data-id="${card.id}">` +
            `<div class="product-thumb">` +
            `<a class="d-block w-100 h-100" href="${linkToProductPage}">` +
            `<img class="d-block w-100 h-100" src="../public/images/catalog/${card.path_to_photo}" alt="image">` +
            `</a>` +
            `</div>` +
            `<div class="card-body">` +
            `<a class="text-reset text-decoration-none" href="${linkToProductPage}">` +
            `<h4 class="card-title fw-bold text-info">${card.name_of_the_object}</h4>` +
            `</a>` +
            `<h6 class="mt-3 mb-3">${fullAddress}</h6>` +
            `<p class="card-text">${card.description}</p>` +
            `<p class="card-price mt-3">${card.price}<span> руб.</span></p>` +
            `<hr class="w-100 border-bottom border-3 border-white">` +
            `<div class="card-body-buttons-wrapper">` +
            `<a class="d-block text-reset text-decoration-none mt-3" href="${SHOW_PRODUCT}&id=${card.id}">` +
            `<button type="button" class="btn btn-info">Подробнее...</button>` +
            `</a>` +
            `<a class="d-block text-reset text-decoration-none mt-3" href="#">` +
            `<button type="button" class="btn btn-success">Оставить заявку</button>` +
            `</a></div>` +
            `<hr class="w-100 border-bottom border-3 border-white">` +
            `<div class="mt-3 w-100 ">` +
            `<div class="ms-auto">` +
            `<select class="form-select change-status-card-select-EVENT" role="button"  aria-label=".form-select-sm example"` +
            `data-id="${card.id}" data-action="update-status">` +
            `<option disabled selected value="">Изменить статус</option>` +
            `<option value="1">Актуально</option>` +
            `<option value="2">Не актуально</option>` +
            `</select>` +
            `</div>` +
            `</div>`;

        if (is_admin) {
            if (card.status === '2') {
                htmlCard += `<h5 class="fw-bold text-warning mt-2 warning-non-actually">Объявление не  актуально</h5>`;
            }
        }

        htmlCard += `</div></div ></div>`;

        // вставляем новые карточки
        // БД всегда получает одни и те же данные (ASC),
        //мы их по-разному вставляем и получается порядок по убыванию/по возрастанию цены
        if (sortParameter === 'ASC' || sortParameter === '') {
            cardsWrapper.insertAdjacentHTML('beforeend', htmlCard);
        } else if (sortParameter === 'DESC') {
            cardsWrapper.insertAdjacentHTML('afterbegin', htmlCard);
        }
    }
}
