# PDO-QueryExecuter Object
Library to execute Query with PDO object

1)Import the php file to your project.<br>
2)When you need to execute a query in your project create a Controller object<br>
3)Call the getData() method of the Controller object to obtain the result<br>


-connect(): Return the PDO object connected to your database.<br>
-ExecuteQuery(PDO,SQL,[Param1],[Param2],[...]): Execute the query on your database, first parameter has to be the PDO object, second the SQL Query, then your parameters.
The parameters are optional, if your query doen't need parameters you can avoid putting them.
You can put as many parameters you need.
