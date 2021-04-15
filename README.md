## QueryBuilder
Строитель запросов.
===========
С помошью QueryBuilder вы сожете выводить данные с базы даных MySQL а так же добовлять, удалять , редактировать


Меттод getAll()
===========

Меттод getAll выводит все записить иp базы! 
- Принимает название таблицы.
- return array()
```php
$db = new QueryBuilder();
$db->getAll('news');
```


Меттод getOne()
===========
Меттод getOne выводит один запись из базы, 
- Принимает название таблицы и id поля
- return array()
```php
$db = new QueryBuilder();
$db->getOne('news', 5);
```



Меттод create()
===========
Меттод create добавляет данные в таблицу, 
- Принимает название таблицы и array 
- return bool
```php
$db = new QueryBuilder();
$db->create('posts', $_POST);
```



Меттод update()
===========
Меттод update редактирует данные 
- Принимает название таблицы и array 
- return bool
```php
$db = new QueryBuilder();
$db->update('posts', $_POST);
```




Меттод delete()
===========
Меттод delete удаляет данные 
- Принимает название таблицы и id поля
- return bool
```php
$db = new QueryBuilder();
$db->delete('posts', $_GET['id']);
```

