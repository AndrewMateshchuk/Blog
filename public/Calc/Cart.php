<?php
  session_start();
  if(isset($_SESSION['Cart'])){
    $Cart = $_SESSION['Cart'];
  }else{
    $Cart = new CartClass();
  }
  if(isset($_POST['show'])){
    $result = $Cart->getCartValues();
    echo json_encode($result);
}elseif (isset($_POST['clear'])){
      unset($_SESSION['Cart']);
    }
  elseif(isset($_POST['zakaz'])){
      if(isset($_POST['fast'])){
          $values = $_POST['data'];
          $Cart->addToCart($values);
      }
    $message = "<div style='max-width:600px;white-space:pre-wrap'><p>Имя получателя : ".$_POST['name']."</p><p>Контакты : ".$_POST['contact']."</p><br />";
    $zakazu = $Cart->getZakazu();
    $type;
    $type_of_type;
    $mailTo = "";//Email получателя
    $uslugi = [
              "Сайт"=>["Простой сайт", "Сайт визитка", "Корпоративный сайт", "Магазин", "Лендинг", "Эксклюзив"],
              "Seo"=>["Seo простой сайт", "Seo сайт визитка", "Seo корпоративный сайт", "Seo магазин", "Конструктор"],
              "Реклама"=>["Яндекс директ", "Google adwords"]
              ];
    $uslui_construct = [
                        "Уникальные тексты","Файл sitemap","Файл robots.txt","Настройка метрики","Настройка вебмастера яндекс",
                        "Настройка Google analitics","Настройка вебмастера гугл","Сбор семантического ядра","Прописать метатеги title",
                        "Прописать метатеги description","Прописать метатеги keywords","Оптимизировать заголовки","Выделение ключевых фраз",
                        "Внутренняя перелинковка","Favicon","Настроить уведомление о неработающем сайте","Страница 404 страницы","Аналитика сайта и рекомендации"
                      ];
    $uslugi_reklamu = [
                        "до 1000",
                        "1001-3000",
                        "3001-5000",
                        "свыше 5000"
                      ];
      if($Cart->numZakazov > 0) {
          foreach ($zakazu as $key => $value) {//Просматриваем заказы
              $keys = array_keys($uslugi);
              $type = $keys[$key];//Получаем Услугу
              foreach ($value as $ke => $val) {
                  $type_of_type = $uslugi[$type][$ke];//Получаем тип услуги
                  foreach ($val as $k => $v) {
                      $message .= "<br /><table><tr><td>Услуга</td><td>" . $type . "</td></tr><tr><td>Тип</td><td>" . $type_of_type . "</td></tr><tr><td>Цена</td><td> " . $v[0] . "</td></tr><tr><td>Дней на заказ</td><td>" . $v[1] . "</td></tr>";
                      if ($key == 0 && $ke >= 0 && $ke < 5) {//Составляем заказ для сайта
                          $message .= "<tr><td>Количество страниц</td><td>" . $v[2] . "</td></tr><tr><td>Дизайн</td><td>" . (($v[3] == "design_gotovii") ? "Готовый" : "На заказ") . "</td></tr><tr><td>Тексты</td><td>" . (($v[4] == "text_sam") ? "Пишет клиент" : "Пишем мы") . "</td></tr></table>";
                      } elseif ($key == 0 && $ke == 5) {//Составляем заказ для эксклюзивного сайта
                          $message .= "<tr><td>Количество страниц</td><td> " . $v[2] . "</td></tr><tr><td>Тип эксклюзивного сайта</td><td> " . $v[3] . "</td></tr><tr><td>Тексты</td><td>" . (($v[4] == "yes") ? "Пишем мы" : "Пишет клиент") . "</td></tr><tr><td>Комментарии</td></tr><tr><td></td><td><div style='max-width: 400px;'>" . $v[5] . "</div></td></tr></table>";
                      } elseif ($key == 1 && $ke < 4) {//Составляем заказ для seo
                          $message .= "<tr><td>Администрирование</td><td>" . (($v[2] === "true") ? "Есть" : "Нету") . "</td></tr></table>";
                      } elseif ($key == 1 && $ke == 4) {//Составляем заказ для seo конструктора
                          $message .= "<tr><td>Количество страниц</td><td> " . $v[2] . "</td></tr><tr><td>Тип сайта</td><td>" . $v[3] . "</td></tr></table>Услуги конструктора :";
                          foreach ($v[4] as $kk => $vv) {//Выбираем услуги конструктора
                              $message .= "<br \>     -" . $uslui_construct[$vv];
                          }
                      } elseif ($key == 2) {//Составляем заказ для рекламы
                          $message .= "<tr><td>Количество ключей</td><td> " . $uslugi_reklamu[$v[2]] . "</td></tr><tr><td>Сопровождение</td><td>" . (($v[3] === "true") ? "Есть" : "Нету") . "</td></tr></table>";
                      }
                      $message .= "<br \>";
                  }
              }
          }
          $message .= '</div>';
      }
    unset($_SESSION['Cart']);
    echo $message;
    }else{
    $values = $_POST['data'];
    $Cart->addToCart($values);
    $_SESSION['Cart'] = $Cart;
    $result = $Cart->getCartValues();
    echo json_encode($result);
  }
  class CartClass
  {
    public $price;
    public $date;
    public $numZakazov;
    public $cart;//0-Сайт, 1-Сео, 2-Реклама
                //[0][0]-Простой сайт,[0][1]-Сайт визитка,[0][2]-Корпоративный сайт,[0][3]-Магазин,[0][4]-Лендинг,[0][5]-Эксклюзив
                //[1][0]-Seo Простой сайт,[1][1]-Seo Сайт визитка,[1][2]- Seo Корпоративный сайт,[1][3]-Seo Магазин,[1][4]-Конструктор
                //[2][0]-Реклама Яндекс,[2][1]-Реклама Гугл
                //Заказ для сайтов [0][0-4][Цена, Дата, Количество страниц, Дизайн, Тексты]  Эксклюзив[0][5][0, 0, Количество страниц, Тип сайта, Тексты, Комментарий]
                //Заказ для Seo [1][0-3][Цена за услугу, Администрирование] Конструктор[1][4][Цена,Дата , Количество странци, Тип сайта для Сео, [Номера выбранных услуг]]
                //Заказ для Рекламы [2][0-1][Дата, Блок по ключам, Сопровождение]
    function __construct()
    {
      $this->price = 0;
      $this->date = 0;
      $this->numZakazov = 0;
      $this->cart = array([[],[],[],[],[],[]],[[],[],[],[],[]],[[],[]]);
    }
    public function addToCart($values)
    {
        array_push($this->cart[$values[0]][$values[1]], $values[2]);
        $this->price += $values[2][0];
        $this->date += $values[2][1];
        $this->numZakazov++;
    }
    public function getZakazu()
    {
      return $this->cart;
    }
    public function getCartValues(){
        if($this->numZakazov == 0) return ["", "", ""];
        return [$this->price, $this->date, $this->numZakazov];
    }
    public function clearCart()
    {
      $this->cart = array([[],[],[],[],[],[]],[[],[],[],[],[]],[[],[]]);
    }
  }
?>