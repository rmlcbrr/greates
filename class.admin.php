 <?php
error_reporting(0);
header('Access-Control-Allow-Origin: *'); 
session_start();
// error_reporting(E_ALL);
//ini_set('display_errors', 1);
require_once('control/dbconfig.php');
//session_start();
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


public function login($query)
	{
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
	$login_date=strtotime(date('Y-m-d'));
		if($stmt->rowCount()>0)
		{

		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		// $remarks = $row['remarks'];
		// $serialized = $row['data'];
		$_SESSION['full_names']=$row['fname']."	".$row['lname'];
		$_SESSION['u_id']=$row['id'];
		$_SESSION['u_account_type']=$row['account_type'];
		$_SESSION['u_date_created']=$row['date_created'];
		$_SESSION['clinic_id']=$row['clinic'];
		$_SESSION['uid_data']=$row['id'];
		$_SESSION['prc_license_number']=$row['prc_license_number'];
		$_SESSION['ptr_number']=$row['ptr_number'];
		$clinic_user=$row['clinic'];
		$stmt2 = $this->conn->prepare("SELECT * from tbl_clinics WHERE id ='$clinic_user' ");
		$stmt2->execute();

		if($stmt2->rowCount()>0)
		{
			
		$row2=$stmt2->fetch(PDO::FETCH_ASSOC);
			$_SESSION['lto_accreditation_no']=$row2['lto_accreditation_no'];

			$_SESSION['lto_expiration_date']=$row2['date_of_expiration_ltms'];
		}


		echo "1,".$row['account_type'];
		}
		else
		{
		echo "0";
		}
		
	}


public function saveQuery($query){
		try{
		$query0=$query;
		$stmt0 = $this->conn->prepare($query0);
		$stmt0->execute();
		return $this->conn->lastInsertId();
			}
		catch(PDOException $e)
		{
			echo $e;
			//$e->getMessage();
		}
}


public function saveQueryWithNoReturn($query){
		try{
		$query0=$query;
		$stmt0 = $this->conn->prepare($query0);
		$stmt0->execute();
		//return $this->conn->lastInsertId();
			}
		catch(PDOException $e)
		{
			echo $e;
			//$e->getMessage();
		}
}


public function updateQuery($query){
		try{
		$query0=$query;
		$stmt0 = $this->conn->prepare($query0);
		$stmt0->execute();
		//echo "done";
			}
		catch(PDOException $e)
		{
			echo $e;
			//$e->getMessage();
		}
}

public function deleteQuery($query)
	{

		try{
		$query0=$query;
		$stmt0 = $this->conn->prepare($query0);
		$stmt0->execute();
		echo "done";
			}
		catch(PDOException $e)
		{
			echo $e;
			//$e->getMessage();
		}
	}
		public function data1($query)
	{
		
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		if($stmt->rowCount()>0)
		{
			$a=1;
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

	echo intval($row['January']).",". intval($row['February']).",". intval($row['March']).",". intval($row['April']).",". intval($row['May']).",". intval($row['June']).",".intval($row['July']).",". intval($row['August']).",". intval($row['September']).",". intval($row['October']).",". intval($row['November']).",". intval($row['December']);
			
		}
		else
		{
echo "0";
		}
	}


}
?>
         