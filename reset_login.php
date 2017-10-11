<?php
$servername = "localhost";
$username = "acct1";
$password = "sgtsi060315";
$dbname = "accounting1";

if (isset($_POST['update']))
{
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$uids= $_POST['uid'];
	
    $sql = "UPDATE users SET is_logged_in='0' WHERE user_id= '$uids'";

    // Prepare statement";

    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED ";


	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    

}
$conn = null;
}
?>

<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>User Id</th><th>Username</th><th>Is Login</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT user_id, username, is_logged_in FROM users"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>


<form method="post" action="reset_login.php">
  <br><br>
  User ID: <input type="text" name="uid">
  
  <input type="submit" name = "update">
</form>