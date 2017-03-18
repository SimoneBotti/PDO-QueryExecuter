# PDO-QueryExecuter
Library to execute Query with PDO object

1)Import the php file to your project.<br>
2)In your project obtain the PDO object using the "connect" function.
3)Use the "ExecuteQuery" function to execute the query.


-connect(): Return the PDO object connected to your database.
-ExecuteQuery(PDO,SQL,List of parameter): Execute the query on your database, first parameter has to be the PDO object, second the SQL Query, then your list of parameter.
