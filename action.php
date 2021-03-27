
<?php 
	// var_dump($_REQUEST['q']);
	// var_dump($_POST);
	$toSend="piyush.bansal8158625@gmail.com";
	$fromMob="";$toMob="";$email="";$date="";$duration="";
	if(isset($_POST['from']))$fromMob=$_POST['from'];
	if(isset($_POST['to']))$toMob=$_POST['to'];
	if(isset($_POST['email']))$email=$_POST['email'];
	if(isset($_POST['date']))$date=$_POST['date'];
	if(isset($_POST['duration']))$duration=$_POST['duration'];

	//email part
	// $msg=$toMob." has called ".$fromMob." for ".$duration;
	$type=$_REQUEST['q'];

	$subject=$type." automation created";
	
	$headers = "From: piyush.bansal8158625@gmail.com";

			
	
	$con=mysqli_connect("localhost","root","","automation");
	$typeOfService="";
	if($type=="message" and $typeOfService==""){
		$txt = $fromMob." has sent a  message ".$toMob." on ".$date;
		$result=mysqli_query($con,"INSERT INTO crm (SID, ACTIVITY_TYPE, FROM_MOB, TO_MOB, DATE, DURATION, EMAIL) VALUES (NULL, '$type', '$fromMob', '$toMob', '$date', NULL, NULL)");
	}
	else if($type=="call" and $typeOfService==""){
		$txt = $fromMob." has called ".$toMob." for ".$duration." mins. ";
		$result=mysqli_query($con,"INSERT INTO crm (SID, ACTIVITY_TYPE, FROM_MOB, TO_MOB, DATE, DURATION, EMAIL) VALUES (NULL, '$type', '$fromMob', '$toMob', '$date', '$duration', NULL)");
	}
	else if($type==	"appointment" and $typeOfService==""){

		$txt = " An Appointment has been booked by  ".$email." for ".$date;
		$result=mysqli_query($con,"INSERT INTO crm (SID, ACTIVITY_TYPE, FROM_MOB, TO_MOB, DATE, DURATION, EMAIL) VALUES (NULL, '$type', NULL, NULL, '$date', NULL, '$email')");
	}
	if(mail($toSend,$subject,$txt,$headers)){
		echo "Email Sent Successfully"."</br> ";
	}
	else{
		echo "Please check error log"."</br>";
	}
	if($result>0){
		echo "Record saved Successfully";
	}
	else{

		echo "</br>Please check SQL Query/ DataSet";
	}
	if(isset($_POST['sqlFetch'])){
	$con=mysqli_connect("localhost","root","","automation");
		$typeOfService=$_POST['sqlFetch'];
		
		if($typeOfService=="all"){
			$result=mysqli_query($con,"select * from crm");
			// if(mysqli_num_rows($result)>0){
			// 	echo "Data fetched";
			// }
		}
		else{

			$result=mysqli_query($con,"select * from crm where ACTIVITY_TYPE='$typeOfService' ");
			// if(mysqli_num_rows($result)>0){
			// 	echo "Data fetched";
			// }
		}
	}

?>
<!DOCTYPE html>

<html>
<head>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		document.getElementByID("goback").onclick=function(){
			document.location.href='/main.php';
		};
	</script>
	<title></title>
</head>
<body>
	<form action="" method="POST">
		<input type="submit" name="sqlFetch" value="all" class="btn btn-success">&nbsp;
		<input type="submit" name="sqlFetch" value="message" class="btn btn-primary">&nbsp;
		<input type="submit" name="sqlFetch" value="call" class="btn btn-info">&nbsp;
		<input type="submit" name="sqlFetch" value="appointment" class="btn btn-warning">&nbsp;
	</form>

	<input type="submit" name="Go Back" value="Go Back to Main Page" id="goback" onClick="myFunction()" class="btn btn-info" ><br>
	<script type="text/javascript">
		function myFunction(){
			window.location.href="main.php";
		}
	</script>
	<br><br>
	<?php if(isset($_POST['sqlFetch'])){ ?>
	<table class="table table-hover">
		<tr>
				<th>SNo.</th>
				<th>Type</th>
			<?php if($typeOfService=="all") {?>
				<th>From Mobile No |</th>
				<th>To Mobile No |</th>
				<th>Date |</th>
				<th>Duration |</th>
				<th>Email |</th>
			<?php } elseif($typeOfService=="message") { ?>
				<th>From Mobile No</th>
				<th>To Mobile No</th>
				<th>Date</th>
			<?php } elseif($typeOfService=="call") {?>
				<th>From Mobile No</th>
				<th>To Mobile No</th>
				<th>Duration</th>
			<?php } elseif($typeOfService=="appointment") {?>	
				<th>Date</th>
				<th>Email</th>
			<?php } ?>
		</tr>
	
		<?php if($typeOfService=="all") {
			while($records=mysqli_fetch_assoc($result)){ ?>
			<tr>
				<?php foreach ($records as $key => $record){
				// var_dump($records);
			?>
			<td><?php echo $record ?></td> 
		<?php } } ?>
			</tr>
		<?php } else {
			while($records=mysqli_fetch_assoc($result)){ ?>
				<tr>
				<?php foreach ($records as $key => $record){ 
					if(strlen($record)>0){
			
			?>
					<td><?php echo $record ?></td> 

		<?php }}} ?>
			</tr>
		<?php } ?>
		
	</table>
	<?php } ?>
	
</body>
</html>