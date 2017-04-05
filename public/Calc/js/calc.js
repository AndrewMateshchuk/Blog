var type = "";//Тип сайта
var zakaz = [];//Заказ
$(document).ready(function () {
    showCart();
});
$(document).on("click", "#site_title", function () {
    if (document.getElementById('site_menu').style.display == "none") {
        $('#site_menu').fadeIn(300);

        $("#website_promotion").hide();
        $('#seo_types').hide();
        $('.individual_constructor').hide();
        $('#advertising_types').hide();
        $('#advertising_volume').hide();

        scrollToBl("#site_menu");
    } else {
        $('#site_menu').fadeOut(300);
        $('.calculate').fadeOut(300);
        $('#siteCalcForm').fadeOut(300);
        $('#exclusive_form').fadeOut(300);

    }
});
$(document).on("click", "#seo", function () {
    if (document.getElementById('website_promotion').style.display == "none") {
        $("#website_promotion").fadeIn(300);

        $('#site_menu').hide();
        $('.calculate').hide();
        $('#siteCalcForm').hide();
        $('#exclusive_form').hide();
        $('#advertising_types').hide();
        $('#advertising_volume').hide();

        scrollToBl("#website_promotion");
    } else {
        $("#website_promotion").fadeOut(300);
        $('#seo_types').fadeOut(300);
        $('.individual_constructor').fadeOut(300);
    }
});
$(document).on("click", "#reklama_title", function () {
    if (document.getElementById('advertising_types').style.display == "none") {
        $('#advertising_types').fadeIn(300);

        $("#website_promotion").hide();
        $('#seo_types').hide();
        $('.individual_constructor').hide();
        $('#site_menu').hide();
        $('.calculate').hide();
        $('#siteCalcForm').hide();
        $('#exclusive_form').hide();

        scrollToBl("#advertising_types");
    } else {
        $('#advertising_types').fadeOut(300);
        $('#advertising_volume').fadeOut(300);
    }
});
$(document).on("click", "#reklamaYandex", function () {
    if (document.getElementById('advertising_volume').style.display == "none") {
        $('#advertising_volume').fadeIn(300);

        scrollToBl("#advertising_volume");

        reklama = 0;
    } else {
        $('#advertising_volume').fadeOut(300);
        reklama = 0;
    }
});
$(document).on("click", "#reklamaGoogleAdw", function () {
    if (document.getElementById('advertising_volume').style.display == "none") {
        $('#advertising_volume').fadeIn(300);

        scrollToBl("#advertising_volume");

        reklama = 1;
    } else {
        $('#advertising_volume').fadeOut(300);
        reklama = 1;
    }
});
$(document).on("click", "#seo_abonent_obslujivanie", function () {
    if (document.getElementById('seo_types').style.display == "none") {
        $('#seo_types').fadeIn(300);

        $('.individual_constructor').hide();

        scrollToBl("#seo_types");
    } else {
        $('#seo_types').fadeOut(300);
    }
});
$(document).on("click", "#seo_constructor", function () {
    if (document.getElementsByClassName('individual_constructor')[0].style.display == "none") {
        $('.individual_constructor').fadeIn(300);

        $('#seo_types').hide();

        scrollToBl(".individual_constructor");
    } else {
        $('.individual_constructor').fadeOut(300);
    }
});
function isCartEmpty() {
    if ($('#NumZakazov').text() == "") {
        $('#cart').fadeOut(300);
    } else {
        $('#cart').fadeIn(300);
    }
}
function showSiteCalc(t) {
    markSelectedSite(t);
    var min;
    var max;
    var site_pages;
    var site_type;
    type = t;
    switch (t) {
        case 0:
            min = 1;
            max = 3;
            site_pages = "Количество страниц";
            site_type = "Сайт «проще некуда»";
            break;
        case 1:
            min = 3;
            max = 10;
            site_pages = "Количество страниц";
            site_type = "Сайт-визитка";
            break;
        case 2:
            min = 11;
            max = 150;
            site_pages = "Количество страниц";
            site_type = "Корпоративный сайт";
            break;
        case 3:
            min = 1;
            max = 5000;
            site_pages = "Количество позиций";
            site_type = "Интернет-магазин";
            break;
        case 4:
            min = 1;
            max = 10;
            site_pages = "Количество блоков";
            site_type = "Landige-page";
            break;
        case 5:
            min = 1;
            max = 10000;
            site_pages = "Количество страниц";
            site_type = "Эксклюзив";
            break;
    }
    document.getElementById('site_pages').min = min;
    document.getElementById('site_pages').max = max;
    $('#site_pages_form').text(site_pages);
    $('#site_type_name').text(site_type);
    $('.calculate').fadeIn(300);
    $('#exclusive_form').hide();
    scrollToBl(".calculate");
    $('#siteCalcForm').fadeIn(300);
}
function ToCalculateSite(type) {
    var pages_num = Math.floor(Number(document.getElementById('site_pages').value)); //Количество страниц
    var answer = [];//Переменная для результата стоимость и дата
    //Проверка вхождения в диапазон
    if (pages_num > Number(document.getElementById('site_pages').max) || pages_num < Number(document.getElementById('site_pages').min)) {
        var answer = ["", ""];
        $('#predlojenie').fadeOut(300);
        showError("site_pages", "Введите число от " + document.getElementById('site_pages').min + " до " + document.getElementById('site_pages').max, false);
    } else {
        removeError("site_pages");
        var site_design = (document.getElementById('site_design').value == "design_gotovii") ? 0 : 1;
        var site_texts = (document.getElementById('site_texts').value == "text_sam") ? 0 : 1;
        switch (type) {
            //Сайт простой | Сайт визитка
            case 0:
            case 1:
                //Формула   колСтраниц*(цена_за_страницу + цена_за_текст)+цена за дизайн
                answer[0] = pages_num * (site_price[type][0] + site_price[type][2][site_texts]) + site_price[type][1][site_design];
                answer[1] = pages_num * site_date[type][0] + site_date[type][1][site_design];
                break;
            //Корпоративный сайт
            case 2:
                //page_type и page_type_text поиск цены по промежуткам страниц
                var page_type = (pages_num > 10 && pages_num < 51) ? 0 :
                    (pages_num > 50 && pages_num < 101) ? 1 : 2;
                //индекс определяем через диапазон + 1, потому-что первое значение 0 для самостоятельного написания текста
                var page_type_text = (site_texts) ? (page_type + 1) : 0;
                answer[0] = pages_num * (site_price[type][0][page_type] + site_price[type][2][page_type_text]) + site_price[type][1][site_design];
                answer[1] = pages_num * site_date[type][0] + site_date[type][1][site_design];
                answer[1] = (answer[1] > 30) ? 30 : Math.ceil(answer[1], 10);
                break;
            //Интернет магазин
            case 3:
                var page_type = (pages_num > 9 && pages_num < 51) ? 0 :
                    (pages_num > 50 && pages_num < 101) ? 1 :
                        (pages_num > 100 && pages_num < 301) ? 2 :
                            (pages_num > 300 && pages_num < 501) ? 3 :
                                (pages_num > 500 && pages_num < 1001) ? 4 : 5;
                var page_type_text = (site_texts) ? ((pages_num > 1000) ? 2 : 1) : 0;
                answer[0] = pages_num * (site_price[type][0][page_type] + site_price[type][2][page_type_text]) + site_price[type][1][site_design];
                answer[1] = pages_num * site_date[type][0] + site_date[type][1][site_design];
                answer[1] = (answer[1] > 45) ? 45 : (answer[1] < 10) ? 10 : Math.ceil(answer[1]);
                break;
            //Landing
            case 4:
                answer[0] = pages_num * site_price[type][0] + site_price[type][1][site_design] + site_price[type][2][site_texts];
                answer[1] = pages_num * site_date[type][0] + site_date[type][1][site_design];
                answer[0] = (answer[0] < 10000) ? 10000 : answer[0];
                break;
        }
        $('#predlojenie').fadeIn(300);
    }
    return answer;
}
function showSiteAnswer(arr) {
    $('#site_answer_price').text(arr[0]);
    $('#site_answer_date').text(arr[1]);
}
function markSelectedSite(t) {
    $(".site_menu_item").removeClass("selected");
    $(".site_menu_item:eq(" + t + ")").addClass("selected");
}
function markSelectedSeo(t) {
    $(".seo_type_item").removeClass("selected");
    $(".seo_type_item:eq(" + t + ")").addClass("selected");
}
function markSelectedAdw(t) {
    $(".context_reklama_menu_item").removeClass("selected");
    $(".context_reklama_menu_item:eq(" + t + ")").addClass("selected");
}
function showExclusive() {
    markSelectedSite(5);
    $('.calculate').fadeIn(300);
    $('#siteCalcForm').hide();
    scrollToBl(".calculate");
    $('#exclusive_form').fadeIn();
}
function ToCalculateSeo() {
    var pages = Number(document.getElementById('seo_pages').value);//Количество страниц
    var answer = [];//Массив возвращаемых значений
    var result = [];//Массив полученых данных
    if ((pages > Number(document.getElementById('seo_pages').max) || pages < Number(document.getElementById('seo_pages').min)) && document.getElementById('seo_type').value != "landing") {
        var answer = ["", ""];
        showError("seo_pages", "Введите число от " + document.getElementById('seo_pages').min + " до " + document.getElementById('seo_pages').max, false);
    } else {
        removeError("site_pages");
        //Результат нулевой это тип по количеству страниц
        //Массив чекбоксов услуг
        var checkbox = document.getElementsByClassName('seo_checkbox_class');
        var checkboxval = [];
        if (document.getElementById('seo_type').value == "landing") {
            result[0] = 5;
            for (var i = 0; i < checkbox.length; i++) {
                if (checkbox[i].checked) {
                    checkboxval.push(i);
                }
            }
            result[1] = checkboxval;
            if (result[1].length === 0) {
                return ["", ""];
            }
            answer[0] = 0;
            for (var i = 0; i < result[1].length; i++) {
                answer[0] += seo_price[5][result[1][i]];
            }
            return answer;
        } else {
            //Результат нулевой это тип по количеству страниц
            result[0] = (pages > 0 && pages < 6) ? 0 :
                (pages > 5 && pages < 11) ? 1 :
                    (pages > 10 && pages < 31) ? 2 :
                        (pages > 30 && pages < 51) ? 3 : 4;
            //Проверяем какие Услуги выбраны и помещаем в массив, в виде массива(Размещаються по порядковому номеру сверху вниз начиная с 0)
            checkboxval = [];
            for (var i = 0; i < checkbox.length; i++) {
                if (checkbox[i].checked) {
                    checkboxval.push(i);
                }
            }
            result[1] = checkboxval;
            if (result[1].length === 0) {
                return ["", ""];
            }
            //Считаем стоимость
            answer[0] = 0;
            answer[0] += (result[1][0] === 0) ? pages * (seo_price[result[0]][result[1][0]]) : 0; //прибавляем стоимость за Уникальные тексты если они есть
            //Если страниц больше 50
            if (result[0] == 4) {
                for (var i = 0; i < result[1].length; i++) {
                    if (result[1][i] == 0) continue;
                    answer[0] += (result[1][i] > 6 && result[1][i] < 14) ? (seo_price[3][result[1][i]] + (pages - 50) * (seo_price[4][result[1][i]][1])) : seo_price[result[0]][result[1][i]];
                }

            } else //Если страниц меньше 50
            {
                for (var i = 0; i < result[1].length; i++) {
                    if (result[1][i] == 0) continue;
                    answer[0] += seo_price[result[0]][result[1][i]];
                }
            }
        }
        return answer;
    }
}
function showSeoAnswer(arr) {
    $('#seo_answer_price').text(arr[0]);
    $('#seo_answer_date').text(10);
}
function addSiteToCart() {
    var result = [];
    var data = [];
    var pages_num = Math.floor(Number(document.getElementById('site_pages').value));
    if (pages_num > Number(document.getElementById('site_pages').max) || pages_num < Number(document.getElementById('site_pages').min)) {
        showError("site_pages", "Введите число от " + document.getElementById('site_pages').min + " до " + document.getElementById('site_pages').max, true);
    } else {
        result.push(0);//Сайт
        result.push(type);//Тип сайта
        price_and_date = ToCalculateSite(type);
        data.push(price_and_date[0]);//4 - Цена
        data.push(price_and_date[1]);//5 - Дата
        data.push(pages_num);//1 - Количество страниц
        data.push(document.getElementById('site_design').value);//2 - Дизайн
        data.push(document.getElementById('site_texts').value);//3 - Тексты
        result.push(data);
        postZakaz(result);
    }
}
function addExclusiveToCart() {
    var result = [];
    var data = [];
    var pages_num = Math.floor(Number(document.getElementById('exclusive_pages').value));
    if(pages_num > Number(document.getElementById('exclusive_pages').max) ||
        pages_num < Number(document.getElementById('exclusive_pages').min) ||
        document.getElementById('exclusive_type_site').value == "" ||
        document.getElementById('exclusive_comment').value == ""
    ){
        showError("exclusive_form_error", "Заполните поля", true);
    }else{
        result.push(0);//0-Сайт
        result.push(5);
        data.push(0);//ЦЕна
        data.push(0);//Дата
        data.push(pages_num);//1 - Количество страниц
        data.push(document.getElementById('exclusive_type_site').value);//2 - Тип сайта
        data.push($('input:radio[name=exclusive_text]:checked').val());//3 - Тексты
        data.push(document.getElementById('exclusive_comment').value);//4 - Комментарий
        result.push(data);
        postZakaz(result);
    }
}
function addSeoAbonentToCart(type) {
    markSelectedSeo(type);
    var result = [];
    var data = [];
    var checkbox = document.getElementsByClassName('adminCheck');
    result.push(1);//Сео
    result.push(type);//Тип абон обсл
    data.push((checkbox[type].checked) ? (abon_price[type][0] + abon_price[type][1]) : abon_price[type][0]);//Цена за услугу
    data.push(0);//Дата
    data.push(checkbox[type].checked);//True или False будет ли клиент брать Администрирование
    result.push(data);
    postZakaz(result);
}
function addSeoToCart() {
    var pages = Number(document.getElementById('seo_pages').value);//Количество страниц
    if ((pages > Number(document.getElementById('seo_pages').max) || pages < Number(document.getElementById('seo_pages').min)) && document.getElementById('seo_type').value != "landing") {
        showError("seo_pages", "Введите число от " + document.getElementById('seo_pages').min + " до " + document.getElementById('seo_pages').max, true);
    } else {
        var result = [];
        var data = [];
        var checkbox = document.getElementsByClassName('seo_checkbox_class');
        var checkboxval = [];
        result.push(1);//0-Сео
        result.push(4);
        checkboxval = ToCalculateSeo();
        data.push(checkboxval[0]);//4- Цена за услуги
        data.push(10);//Дата
        checkboxval = [];
        data.push(pages);//1-Количество сттаниц
        data.push(document.getElementById('seo_type').value);//2-Тип сайта для сео
        for (var i = 0; i < checkbox.length; i++) {
            if (checkbox[i].checked) {
                checkboxval.push(i);
            }
        }
        data.push(checkboxval);//3-Выбранные услуги
        if (checkboxval.length === 0) {
            $('#seoCalcForm > table > tbody > tr:nth-child(3)').before('<tr class="error_msg text-center" style="font-weight: bold; margin: 5px; color: #a94442;"><td colspan="2">Выберите хотя-бы одну из предложенных услуг.</td><tr>');

            $('html, body').animate({ scrollTop: $(".error_msg").offset().top }, 500);

            setTimeout(function () {
                $('.error_msg').remove();
            }, 3000);
        } else {
            result.push(data);
            postZakaz(result);
        }
    }
}
function addReklamaToCart(block) {
    markSelectedAdw(block);
    var result = [];
    var data = [];
    var checkbox = document.getElementsByClassName('accomp');
    result.push(2);//0-Реклама
    result.push(reklama);//1 - Тип рекламы (Яндекс, Google)
    data.push((checkbox[block].checked) ? (reklama_price[block][0] + reklama_price[block][1]) : reklama_price[block][0]);//4-Цена за услугу
    data.push(reklama_date[block]);//Дата
    data.push(block);//2 - блок рекламы по ключам
    data.push(checkbox[block].checked);//3-True или False будет ли клиент брать Сопровождение
    result.push(data);
    postZakaz(result);
}
function fastSiteZakaz() {
    var data = [];
    zakaz = [];//Сюда кладем заказ(Глоб переменная)
    var pages_num = Math.floor(Number(document.getElementById('site_pages').value));
    if(pages_num > Number(document.getElementById('site_pages').max) || pages_num < Number(document.getElementById('site_pages').min)){
        showError("site_pages", "Введите число от " + document.getElementById('site_pages').min + " до " + document.getElementById('site_pages').max, true);
    }else{
        zakaz.push(0);//Сайт
        zakaz.push(type);//Тип сайта
        price_and_date = ToCalculateSite(type);
        data.push(price_and_date[0]);//4 - Цена
        data.push(price_and_date[1]);//5 - Дата
        data.push(pages_num);//1 - Количество страниц
        data.push(document.getElementById('site_design').value);//2 - Дизайн
        data.push(document.getElementById('site_texts').value);//3 - Тексты
        zakaz.push(data);
        $.fancybox.open($(".fancybox"));
    }
}
function fastExclusiveZakaz() {
    zakaz = [];    var data = [];
    var pages_num = Math.floor(Number(document.getElementById('exclusive_pages').value));
    if(pages_num > Number(document.getElementById('exclusive_pages').max) ||
        pages_num < Number(document.getElementById('exclusive_pages').min) ||
        document.getElementById('exclusive_type_site').value == "" ||
        document.getElementById('exclusive_comment').value == ""
    ){
        showError("exclusive_form_error", "Заполните поля", true);
    }else{
        zakaz.push(0);//0-Сайт
        zakaz.push(5);
        data.push(0);//ЦЕна
        data.push(0);//Дата
        data.push(pages_num);//1 - Количество страниц
        data.push(document.getElementById('exclusive_type_site').value);//2 - Тип сайта
        data.push($('input:radio[name=exclusive_text]:checked').val());//3 - Тексты
        data.push(document.getElementById('exclusive_comment').value);//4 - Комментарий
        zakaz.push(data);
        $.fancybox.open($(".fancybox"));//Открываем форму для ввода данных пользователя
    }
}
function fastSeoZakaz() {
    zakaz = [];
    var pages = Number(document.getElementById('seo_pages').value);//Количество страниц
    if ((pages > Number(document.getElementById('seo_pages').max) || pages < Number(document.getElementById('seo_pages').min)) && document.getElementById('seo_type').value != "landing") {
        showError("seo_pages", "Введите число от " + document.getElementById('seo_pages').min + " до " + document.getElementById('seo_pages').max, true);
    }else {
        var data = [];
        var checkbox = document.getElementsByClassName('seo_checkbox_class');
        var checkboxval = [];
        zakaz.push(1);//0-Сео
        zakaz.push(4);
        checkboxval = ToCalculateSeo();
        data.push(checkboxval[0]);//4- Цена за услуги
        data.push(0);//Дата
        checkboxval = [];
        data.push(pages);//1-Количество сттаниц
        data.push(document.getElementById('seo_type').value);//2-Тип сайта для сео
        for (var i = 0; i < checkbox.length; i++) {
            if(checkbox[i].checked){
                checkboxval.push(i);
            }
        }
        data.push(checkboxval);//3-Выбранные услуги
        if (checkboxval.length === 0) {
            $('#seoCalcForm > table > tbody > tr:nth-child(3)').before('<tr class="error_msg text-center" style="font-weight: bold; margin: 5px; color: #a94442;"><td colspan="2">Выберите хотя-бы одну из предложенных услуг.</td><tr>');

            $('html, body').animate({ scrollTop: $(".error_msg").offset().top }, 500);

            setTimeout(function () {
                $('.error_msg').remove();
            }, 3000);
        }else {
            zakaz.push(data);
            $.fancybox.open($(".fancybox"));
        }
    }
}
function postZakaz(value) {
    $.post(
        "Cart.php",
        {
            "data": value
        },
        function (data) {
            var d = JSON.parse(data);
            var date = new Date;
            date.setDate(date.getDate() + d[1]);
            $('#SummaZakazov').text(d[0]);
            $('#DataZakazov').text(date.getDate() + "." + (date.getMonth() + 1) + "." + date.getFullYear());
            $('#NumZakazov').text(d[2]);
            showBasketMsg("Товар добавлен в корзину.");
            isCartEmpty();
        }
    ).error(
        function () {
            showBasketMsg("Ошибка подключения к серверу.");
        }
    );
}
function sendedZakaz() {
    //Заказ отправлен, добавить сообщение в форму
    $('#SummaZakazov').text("");
    $('#DataZakazov').text("");
    $('#NumZakazov').text("");
    isCartEmpty();
    $("#form_success").fadeIn(300);
    $('#name').val("");
    $('#phone_number').val("");
    setTimeout(function(){$("#form_success").fadeOut(300);$.fancybox.close();}, 2500);
}
function sendCartZakaz() {
    //Во время отправки можно добавить анимацию загрузки
    if (document.getElementById('name').value == "" || document.getElementById('phone_number').value == "") {
        showError('cartForm', 'Введите данные');
        setTimeout(function () {
            removeError('cartForm')
        }, 1500);}
        else{
        if(zakaz != ""){
            $.post(
                "Cart.php",
                {
                    "fast": true,
                    "data": zakaz,
                    "zakaz": true,
                    "name": document.getElementById('name').value,
                    "contact": document.getElementById('phone_number').value
                },
                function(data){
sendedZakaz();
alert('В ответе сервера можно увидеть формат заказа, который приходит на email студии');
                   }//Успешно
            ).error(
                function () {
                    //Ошибка подключения к серверу, вывести сообщение в форму
                }
            );
        }else if($('#NumZakazov').text() == ""){
        }else{
            $.post(
                "Cart.php",
                {
                    "zakaz": true,
                    "name": document.getElementById('name').value,
                    "contact": document.getElementById('phone_number').value
                },
                function(data){
sendedZakaz();
alert('В ответе сервера можно увидеть формат заказа, который приходит на email студии');
}
            ).error(
                function () {
                    //Ошибка подключения к серверу, вывести сообщение в форму
                }
            );
    }}
}
function showCart() {
    $.post(
        "Cart.php",
        {
            "show": "true"
        },
        function (data) {
            var d = JSON.parse(data);
            var date = new Date;
            date.setDate(date.getDate() + d[1]);
            $('#SummaZakazov').text(d[0]);
            $('#DataZakazov').text(date.getDate() + "." + (date.getMonth() + 1) + "." + date.getFullYear());
            $('#NumZakazov').text(d[2]);
            isCartEmpty();
        }
    );
}
function clearCart() {
    $.post(
        "Cart.php",
        {
            "clear": true
        },
        function () {
            var date = new Date;
            $('#SummaZakazov').text("");
            $('#DataZakazov').text(date.getDate() + "." + (date.getMonth() + 1) + "." + date.getFullYear());
            $('#NumZakazov').text("");
            isCartEmpty();
        }
    ).error(
        function () {
            showBasketMsg("Ошибка подключения к серверу.");
        }
    );
}
function showError(elem_id, error_text, focus) { // 1. id элемента; 2. Текст для вывода над элементом; 3. Добавлять (true) или нет (false) обработчик focus
    var $form_elem = $("#" + elem_id);
    var $form_elem_parent_block = $($form_elem).parent();
    //$('html, body').animate({ scrollTop: $($form_elem_parent_block).offset().top }, 500);

    if (!$($form_elem_parent_block).hasClass("has-error")) {
        $($form_elem_parent_block).addClass("has-error");
        $($form_elem).before('<label class="control-label" for="' + elem_id + '">' + error_text + '</label>');

        if (focus) {
            $($form_elem).focus(function () {
                $($form_elem_parent_block).removeClass("has-error");
                $($form_elem_parent_block).find("label").remove();

                $($form_elem).unbind('focus');
            });
        }
    }
}
function removeError(elem_id) {
    var $form_elem_parent_block = $("#" + elem_id).parent();
    $($form_elem_parent_block).removeClass("has-error");
    $($form_elem_parent_block).find("label").remove();
}
function showBasketMsg(msg_text) {
    var $basket_info = $("#basket_info");
    if(!$("#msg")[0]) {
        $($basket_info).before('<div id="msg">' + msg_text + '</div>');
    }
    var $msg_block = $("#msg");
    scrollToBl("#page-breadcrumb");
    $($basket_info).hide();
    $($msg_block).fadeIn(300);
    setTimeout(function () {
        $($msg_block).fadeOut(300);
    }, 2500);
    setTimeout(function () {
        $($basket_info).fadeIn(300);
    }, 2800);
}
function scrollToBl(block) {
    $('html, body').animate({ scrollTop: $(block).offset().top }, 500);
}