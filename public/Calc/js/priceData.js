//Цена для сайтов
var site_price = [
    //Простой сайт
    [
        1000,//Цена за страницу
        [2500, 6000],//Цена за дизайн(1-Шаблон, 2-Индивидуальный)
        [0, 500]//Цена за текст(1-Сам, 2-Мы)
    ],
    //Сайт визитка
    [
        1000,
        [3500, 7000],
        [0, 400]
    ],
    //Сайт Корпоративный
    [
        [500, 400, 300],//Цена за страницу( 1) 11-50 страниц 2) 51-100 страниц 3) 101-150 страниц)
        [5000, 15000],
        [0, 250, 200, 170]//Цена за текст( 1) Сам 2) 11-50 страниц 3) 51-100 страниц 4) 101-150 страниц)
    ],
    //Интернет магазин
    [
        [200, 170, 75, 50, 30, 20],//Цена за позицию( 1) 10-50 страниц 2) 51-100 страниц 3) 101-300 страниц 4) 301-500 страниц 5) 501-1000 страниц 6) 1001-5000 страниц)
        [10000, 20000],
        [0, 50, 40]
    ],
    //Лендинг
    [
        1000,//За блок
        [7000, 18000],//Дизайн
        [0, 2000]//Тексты
    ]
];
//Даты выполнения для сайтов
var site_date = [
    //Сайт простой
    [
        1,//На страницу
        [1, 7]//Дизайн
    ],
    //Сайт визитка
    [
        1,
        [1, 9]
    ],
    //Сайт Корпоративный
    [
        1,
        [2, 9]
    ],
    //Интернет магазин=
    [
        0.05,
        [3, 14]
    ],
    //Лендинг
    [
        1,
        [1, 10]
    ]
];
//Цена для seo
//Цена,  Цена за стр(если страниц > 50)
var seo_price = [
    //Страницы 1-5
    [
        250,
        2500,
        1500,
        2000,
        1500,
        2000,
        1500,
        2500,
        1000,
        1000,
        1000,
        1000,
        1000,
        1000,
        1500,
        1500,
        3000,
        4000
    ],
    //Страницы 6-10
    [
        250,
        2500,
        1500,
        2000,
        1500,
        2000,
        1500,
        3000,
        1500,
        1500,
        1500,
        1500,
        1500,
        1500,
        1500,
        1500,
        3000,
        4000,
    ],
    //Страницы 11-30
    [
        250,
        2500,
        1500,
        2000,
        1500,
        2000,
        1500,
        3500,
        2000,
        2000,
        2000,
        2000,
        2000,
        2000,
        1500,
        1500,
        3000,
        4000
    ],
    //Страницы 31-50
    [
        250,
        2500,
        1500,
        2000,
        1500,
        2000,
        1500,
        4500,
        3000,
        3000,
        3000,
        3000,
        3000,
        3000,
        1500,
        1500,
        3000,
        4000
    ],
    //Страницы > 50
    [
        250  //Уникальные тексты
        , 2500  //Файл sitemap
        , 1500 //Файл robots.txt
        , 2000 //Настройка метрики
        , 1500  //Настройка вебмастера яндекс
        , 2000   //Настройка Google analitics
        , 1500
        ,
        [
            4500, 30   //Сбор семантического ядра
        ],
        [
            3000, 20   //Прописать метатеги title
        ],
        [
            3000, 20   //Прописать метатеги description
        ],
        [
            3000, 20  //Прописать метатеги keywords
        ],
        [
            3000, 20   //Оптимизировать заголовки
        ],
        [
            3000, 20  //Выделение ключевых фраз
        ],
        [
            3000, 20   //Внутренняя перелинковка
        ],
        1500,
        1500,
        3000,
        4000
    ],
    //Лендинг
    [
        1000  //Уникальные тексты
        , 2500  //Файл sitemap
        , 1500  //Файл robots.txt
        , 2000   //Настройка метрики
        , 1500  //Настройка вебмастера яндекс
        , 2000   //Настройка Google analitics
        , 1500   //Настройка вебмастера гугл
        , 2500   //Сбор семантического ядра
        , 1000   //Прописать метатеги title
        , 1000   //Прописать метатеги description
        , 1000   //Прописать метатеги keywords
        , 1000   //Оптимизировать заголовки
        , 1000   //Выделение ключевых фраз
        , 1000  //Внутренняя перелинковка
        , 1500   //Favicon
        , 1500  //Настроить уведомление о неработающем сайте
        , 3000   //Страница 404 страницы
        , 4000    //Аналитика сайта и рекомендации
    ]
];

//Цена для абонентского обслуживания
var abon_price = [
    [
        10000, 10000
    ],
    [
        20000, 15000
    ],
    [
        20000, 15000
    ],
    [
        10000, 5000
    ]
];

//Цена за рекламу
var reklama_price = [
    [
        5000, 3000
    ],
    [
        9000, 6000
    ],
    [
        15000, 9000
    ],
    [
        25000, 12000
    ]
];

var reklama_date = [2, 4, 5, 6];
