@extends('index')
@section('content')
    <div class="container-fluid">
        <img style="margin: auto;box-shadow:  0 0 5px rgba(0,0,0,0.5);border-radius: 4px;max-height: 50vh" class="img-responsive" src="/../public/images/avatar_night_in_the_woods.jpg">
        <div class="col-sm-8 col-sm-offset-2" style="font-size: medium;font-family: Helvetica Neue, Helvetica, Arial, sans-serif;">
            <h2>О сайте : </h2>
            <div>
                Сайт создан в целях обучения.</br>
                В нем реализованы :
                <ul>
                    <li>регистрация с разделением прав пользователей</li>
                    <li>добавление, редактирование и удаление записей</li>
                    <li>комментирование и оценивание записей</li>
                    <li>профили авторов</li>
                    <li>онлайн-чат</li>
                    <li>калькулятор для расчета стоимости заказа сайтов</li>
                </ul>
                Были использованы следующие фреймворки :
                <ul>
                    <li>Laravel</li>
                    <li>JQuery</li>
                    <li>Bootstrap</li>
                </ul>
                Контакты :
                <ul>
                    <li>Email, Skype : mateshchuk@gmail.com</li>
                </ul>
                <h2 style="text-align: center">To be continue...</h2>
            </div>
        </div>
    </div>
@stop