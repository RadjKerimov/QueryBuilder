<?php

   class QueryBuilder {
      private $pdo = null;

      public function __construct(){
         try {
            $this->pdo = new PDO("mysql:host=localhost; dbname=app3; charset=utf8;", 'root', 'root');
         } catch (PDOException $th) {
            exit($th->getMessage());
         }
      }

      


      /*
      * Выводит все из выбранной таблицы
      * Принемает навзание таблицы string
      * return array
      */

      public function getAll($table){
         $prepare = $this->pdo->prepare("SELECT * FROM {$table}");
         $prepare->execute();
         return $prepare->fetchAll(PDO::FETCH_ASSOC);
      }




      /*
      * Выводит одно поля по ID 
      * Принемает навзание таблицы string и id
      * return bool
      */
      public function getOne($table, $id){
         $prepare = $this->pdo->prepare("SELECT * FROM {$table} WHERE id=?");
         $prepare->execute([$id]);
         return $prepare->fetch(PDO::FETCH_ASSOC);
      }




      /*
      * Удаляет данные с таблицы! 
      * Принемает название таблицы и id
      * return bool   
      */
      public function delete($table, $id){
         $prepare = $this->pdo->prepare("DELETE FROM {$table} WHERE id=?");
         return $prepare->execute([$id]);
      }





      /*
      * Добовляет данные в таблицу! 
      * Принемает название таблицы  string $table  и  параметры в виде массива
      * return bool   
      */     
      public function create($table, $data){
         $key = implode(',', array_keys($data));
         $values = null;

         for ($i=0; $i < count(array_values($data)); $i++) { 
            $values .= '?,';
         }
         $value = rtrim($values, ',');        
         $prepare = $this->pdo->prepare("INSERT INTO {$table} ({$key}) VALUES ({$value})");
         return $prepare->execute(array_values($data));
      }


      

      /*
      * Рудактирует данные 
      * Принемает название таблицы и массив с параметрами!
      * return boll
      */
      public function update($table, $data){
         $id = $data['id'];
         unset($data['id']);
         $string = null;

         foreach (array_keys($data) as $key => $value) {
            $string .= $value . '=:' . $value . ',';
         }

         $keys = rtrim($string, ',');
         $data['id'] = $id;

         $prepare = $this->pdo->prepare("UPDATE {$table} SET {$keys} WHERE `id`= :id");
         return $prepare->execute($data);
      }




   }
?>