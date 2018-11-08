# PDO-QueryExecuter Object

Library to execute Query with PDO object in PHP ![PHP logo](/php_logo.png)

1. Import the php file to your project.
2. When you need to execute a query in your project create a Controller object
3. Call the getData() method of the Controller object to obtain the result

## Controller.class

### getData()

```php
 public function getData(SQL, [Param1, Param2, ...]): array 
 ``` 

  Execute the query on your database and return the resulting array. First parameter has to be the SQL Query, then your parameters.
  The parameters are optional, if your query doen't need parameters you can avoid putting them.
  You can put as many parameters as you need.

### getRowCount()

```php
 public function getRowCount(): int 
 ```  

  Return the rows count of the resulting array.

### hasResult()

```php
 public function hasResult(): bool
 ```  

  Return **true** if the resulting array has at least one row, **false** if it has 0 row.

### execute()

```php
 public function execute(SQL, [Param1, Param2, ...]): bool 
 ```  

  Return **true** if the query executed correctly, **false** otherwise.

### sqlHasResult()

```php 
public function sqlHasResult(SQL, [Param1, Param2, ...]): bool 
```  

  Return **true** if the query has at least one result, **false** otherwise

Php Example:

```php 
//File where you need to execute Query<br>

  require_once 'Controller.class.php';

  $controller = new Controller("YOUR DATABASE NAME", "USERNAME", "PASSWORD");  

  $result_array = $controller->getData("YOUR SQL QUERY", [Param1], [Param2]);


  //In $result_array you will have the associative array of the result of the query.
  //In this format, ['Field Name'],value.
  
  //For Example to point the field Name
  $name = $result_array['Name'];
  
  
  //If you have to do multiple Querys to the same Database you need just one controller object:

  $controller = new Controller("YOUR DATABASE NAME", "USERNAME", "PASSWORD");

  $result_array = $controller->getData("YOUR FIRST SQL QUERY", [Param1], [Param2]);
  $result_array2 = $controller->getData("YOUR SECOND SQL QUERY", [Param1], [Param2]);
```
