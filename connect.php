<?php

ob_start();
 

//database credentials
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','skilltest');

$con = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

 if($con === false){
 	die("ERROR: Could not connect. " . mysqli_connect_error());

 }

//  // Attempt select query execution
// $sql = "SELECT * FROM user";
// if($result = mysqli_query($con, $sql)){
//     if(mysqli_num_rows($result) > 0){
//         echo "<table>";
//             echo "<tr>";
//                 echo "<th>id</th>";
//                 echo "<th>email</th>";
//                 echo "<th>name</th>";
//                 echo "<th>date create</th>";
//             echo "</tr>";
//         while($row = mysqli_fetch_array($result)){
//             echo "<tr>";
//                 echo "<td>" . $row['uid'] . "</td>";
//                 echo "<td>" . $row['email'] . "</td>";
//                 echo "<td>" . $row['name'] . "</td>";
//                 echo "<td>" . $row['dcreate'] . "</td>";
//             echo "</tr>";
//         }
//         echo "</table>";
//         // Free result set
//         mysqli_free_result($result);
//     } else{
//         echo "No records matching your query were found.";
//     }
// } else{
//     echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
// }
 
// // Close connection
// mysqli_close($con);

 

// function curPageName() {
//  return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
// }
 
 

?>