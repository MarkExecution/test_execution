###Пояснения к решению задания###

1. Статусы заданий обозначаются цветом фона:  
   - белый: новое задание  
   - желтый: задание изменено администратором  
   - зелёный: задание выполнено  
    
2. Переключение статусов **администратором** осуществляется кликом по полям "Пользователь" и "E-mail" задания, 
   а переключение в статус "Изменено" - изменением информации в поле "Задание".
   
3. Файл conf.php необходимо переместить в вышестоящий каталог,
   по отношению к корневому (Если я правильно понял требование)
   
4. Т.к. задание тестовое, то необрабатываются ошибки файловой системы

5. Структура таблиц в файле migration.sql

6. Оконные функции LEAD и LAG не работают в используемой на сайте верии MySql. Используется заменяющая функция


