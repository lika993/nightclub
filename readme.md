
## О проекте

NightClub - тестовое задание для приема на работу в FIX, написанный на laravel и vue фреймворках
Переменные окружения:
* local
* dev
* production 

## Условие

В ночной клуб приходят мальчики и девочки. Некоторые из них любят, могут или умеют танцевать. Каждый персонаж, пришедший в ночной клуб, может обладать разными навыками танца под разную музыку.

Когда играет Rnb на танцполе танцуют те, кто танцуют хип-хоп, рнб. Когда играет Electrohouse на танцполе танцуют те, кто танцуют Electrodance, house. Когда играет Поп-музыка танцуют те, кто умеют танцевать под поп-музыку. Если человек не умеет танцевать под данную музыку, он идет в бар и пьет водку.

Танцы представляют из себя движения телом, руками, ногами, головой. В разных танцах они задействованы по-разному:

в хип хопе покачивание телом вперед-назад, ноги в полуприсяде, руки согнуты в локтях, головой вперед-назад.
в электродэнс покачивание туловищем вперед-назад, почти нет движения головой, круговые движения-вращения руками, ноги двигаются в ритме.
в танцах под поп-музыку в основном плавные движения туловищем, руками, ногами и головой.

Необходимо эмулировать ночной клуб с произвольным количеством разных персонажей и с произвольным набором умений танцевать у каждого из них. В то время, когда они слышат музыку, персонажи должны соответствующим образом себя вести: танцевать или пить водку в баре.

Реализовать минимальный фронт.

## Описание


* При запуске приложения создается 15 человек с произвольным уровнем танцевальных скиллов
* При нажатии на кнопку "Пустить в клуб еще 5 человек" создается 5 новых людей с произвольным уровнем скиллов
* При нажатии на кнопку "Сменить музыку" меняется трек
* При нажатии на кнопку "Показать/Скрыть движения" раскрывается/скрывается список танцевальных движений, выполняющихся на данный момент
* По анимированным изображениям видим, кто что танцует (есть определенный набор изображений для каждого танца) - изображение для каждого посетителя клуба выбирается рандомно, чтобы разнообразить движение танцпола


## P.S.
"В ближайшем будущем" планируется внедрение плеера для большей динамики клуба

## Как запустить

* склонировать сервис в желаемую папку, далее именуем ее FOLDER в документе
* Скопировать конфиги для сервиса в файлы *.env*
```
   cp -p .env.example .env
```
* [Установить composer](https://getcomposer.org/) и выполнить
```php
php composer.phar install
```
*  заменить на свои конфиги:


   ------------
         APP_ENV - переменная окружения 
         APP_KEY - секретный ключ приложения
         APP_DEBUG - включить или выключить показ ошибок на сервисе
         DB_CONNECTION=dbc
         DB_HOST=dbhost
         DB_PORT=3306
         DB_DATABASE=dbaname
         DB_USERNAME=dbuser
         DB_PASSWORD=dbpass

* Почистить конфиги
 ```
php artisan config:clear
 ```
* Сгенерировать случайный ключ командой
```
php artisan key:generate
```
* Запустить миграции
```
php artisan migrate
 ```
* Задать права 777 для папки FOLDER/storage
```
sudo chmod 777 -R storage
```
* Запустить в консоли - запустить проект локально
```
php artisan serve
 ```
* Скомпилировать фронт
 ```sh
 npm i
npm run watch
 ```
