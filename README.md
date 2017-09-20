# PDO-QueryExecuter Object
Library to execute Query with PDO object

1)Import the php file to your project.<br>
2)When you need to execute a query in your project create a Controller object<br>
3)Call the getData() method of the Controller object to obtain the result<br>

CONTROLLER <br>
-getData(SQL,[Param1],[Param2],[...]): Execute the query on your database and return the resulting array, first parameter has to be the SQL Query, then your parameters.
The parameters are optional, if your query doen't need parameters you can avoid putting them.
You can put as many parameters as you need.

-<b>getRowCount()</b>: Return the rows count of the resulting array.<br><br>

-hasResult(): Return true if the resulting array has at least one row, False if it has 0 row.<br><br>

Php Example:

//YOUR PHP FILE<br>
//File where you need to execute Query<br>
  $controller=new Controller("YOUR DATABASE NAME","USERNAME","PASSWORD");<br>
  $result_array=$controller->getData("YOUR SQL QUERY",[Param1],[Param2]);<br>
<br>
//In $result_array you will have the associative array of the result of the query.<br>
//In this format, ['Field Name'],value.<br>
For Example to point the field Name<br>
  $result_array['Name']<br><br><br>
  
  
  If you have to do multiple Querys to the same Database you need just one controller object:<br><br>
  
  Example:<br>
  //YOUR PHP FILE <br>
  //File where you need to execute Query<br>
    $controller=new Controller("YOUR DATABASE NAME","USERNAME","PASSWORD");<br>
    $result_array=$controller->getData("YOUR FIRST SQL QUERY",[Param1],[Param2]);<br>
    $result_array2=$controller->getData("YOUR SECOND SQL QUERY",[Param1],[Param2]);<br>
  
