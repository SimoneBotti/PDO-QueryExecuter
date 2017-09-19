# PDO-QueryExecuter Object
Library to execute Query with PDO object

1)Import the php file to your project.<br>
2)When you need to execute a query in your project create a Controller object<br>
3)Call the getData() method of the Controller object to obtain the result<br>


-getData(SQL,[Param1],[Param2],[...]): Execute the query on your database and return the resulting array, first parameter has to be the SQL Query, then your parameters.
The parameters are optional, if your query doen't need parameters you can avoid putting them.
You can put as many parameters as you need.

Php Example:

//YOUR PHP FILE
//File where you need to execute Query
  $controller=new Controller("YOUR DATABASE NAME","USERNAME","PASSWORD");
  $result_array=$controller->getData("YOUR SQL QUERY",[Param1],[Param2]);

//In $result_array you will have the associative array of the result of the query.
//In this format, ['Field Name'],value.
For Example to point the field Name
  $result_array['Name']
  
  
  If you have to do multiple Querys to the same Database you need just one controller object:
  
  Example:
  //YOUR PHP FILE 
  //File where you need to execute Query
    $controller=new Controller("YOUR DATABASE NAME","USERNAME","PASSWORD");
    $result_array=$controller->getData("YOUR FIRST SQL QUERY",[Param1],[Param2]);
    $result_array2=$controller->getData("YOUR SECOND SQL QUERY",[Param1],[Param2]);
  
