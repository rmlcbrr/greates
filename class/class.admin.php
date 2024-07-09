 <?php
header('Access-Control-Allow-Origin: *'); 
error_reporting(0);
// error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once('dbconfig.php');
session_start();
class admin
{
	private $conn;
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
		
    }
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	
	public function logs($query)
	{
		try
		{

			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			//echo "1";
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}
	
	public function getLast($query)
	{
		try
		{
			
			$stmt = $this->conn->prepare($query);
			$stmt->execute();
			if($stmt->rowCount()>0)
		{
	
		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		echo $row['id']+1;
		}
		else
		{
		echo "1";
		}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
		
	}

public function login($query)
	{
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
	$login_date=strtotime(date('Y-m-d'));
		if($stmt->rowCount()>0)
		{

		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		$_SESSION['uid']=$row['id'];
		$_SESSION['fullname']=$row['fname']."	".$row['lname'];
		$_SESSION['account_types']=$row['account_type'];
		echo "1";
		}
		else
		{
		echo "0";
		}
		
	}

}
?>
         