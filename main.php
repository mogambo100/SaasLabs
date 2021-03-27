<?php 
	$typeOfAutomation="";
	$flag="";
	
	$error=["from"=>"","to"=>"","email"=>"","add"=>"","duration"=>""];
	$value=["from"=>"","to"=>"","email"=>"","duration"=>""];
	if(isset($_POST['command'])){
		$typeOfAutomation=$_POST['command'];
	}
	$checkAllGood=0;

	if(isset($_POST['message'])){
		$flag="message";
		$to=$_POST['to'];
		$from=$_POST['from'];
		$value["from"]=$from;
		$value["to"]=$to;
		if(strlen($to)!=10){
			$error["to"]="Please enter 10 digits in TO";	
			$checkAllGood++;
		}
		if(strlen($from)!=10){
			$error["from"]="Please enter 10 digits in FROM";	
			$checkAllGood++;
		}
		if($to==$from){
			$error["add"]="Please enter diff. numbers";	
			$checkAllGood++;
		}		
	}
	if(isset($_POST['call'])){
		$flag="call";
		$to=$_POST['to'];
		$from=$_POST['from'];
		$duration=$_POST['duration'];
		$value["from"]=$from;
		$value["to"]=$to;
		$value["duration"]=$duration;
		if(strlen($to)!=10 or !is_numeric($to)){
			$error["to"]="Please enter 10 digits in TO";
			$checkAllGood++;
	
		}
		if(strlen($from)!=10 or !is_numeric($from)){
			$error["from"]="Please enter 10 digits in FROM";	
			$checkAllGood++;
		}
		if($to==$from){
			$error["add"]="Please enter diff. numbers";	
			$checkAllGood++;
		}
		if(!is_numeric($duration)){
			$error["add"]="Please enter correct duration";	
			$checkAllGood++;
		}
		if(strlen($duration)==0){
			$error["duration"]="Please enter a valid duration";	
			$checkAllGood++;
		}

		// $typeOfAutomation=$_POST['command'];
	}
	if(isset($_POST['appointment'])){
		$flag="appointment";
		$email=$_POST['email'];
		$value["email"]=$email;
		if(strlen($email)==0){
			$error["email"]="Please enter a valid email address";
			$checkAllGood++;
		}
		// $typeOfAutomation=$_POST['command'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title></title>
</head>
<body>
	<h1>Automation Window</h1><br>
	<span>Please select a option to Automate</span>
	<br><br><br>
	<form action="" method="post">
		<input type="submit" name="command" value="message" class="btn btn-primary">&nbsp;
		<input type="submit" name="command" value="call" class="btn btn-success">&nbsp;
		<input type="submit" name="command" value="Appointment" class="btn btn-info">&nbsp;
		<input type="submit" name="command" value="Reset" class="btn btn-warning">&nbsp;
	</form>
	<?php if($typeOfAutomation=="message" or $flag=="message") { ?>
		<br><br><br>
		<span>Please input the below fields to proceed.</span><br>
		<br>
		<fieldset width="100">
			<legend>Message</legend>
			<form action="<?php if($checkAllGood==0)echo "action.php?q=message" ?>" method="post">
				<span>From: </span><input type="text" name="from" placeholder="1234567890" value="<?php echo $value["from"] ?>">&nbsp;
				<span>To: </span><input type="text" name="to" placeholder="1234567890" value="<?php echo $value["to"] ?>"><br><br>
				<span>Date: </span><input type="date" name="date" value="<?php echo date("Y-m-d"); ?>"><br><br><br><br><br>
				
				<input type="submit" name="message" value="Submit" class="btn btn-success"><br>
			</form>
		</fieldset>
	<?php } elseif($typeOfAutomation=="call" or $flag=="call") {?>
		<br><br><br>
		<span>Please input the below fields to proceed.</span><br>
		<br>
		<fieldset width="100">
			<legend>Call</legend>
			<form action="<?php if($checkAllGood==0)echo "action.php?q=call" ?>" method="post">
				<span>From: </span><input type="text" name="from" placeholder="1234567890" value="<?php echo $value["from"] ?>">&nbsp;
				<span>To: </span><input type="text" name="to" placeholder="1234567890" value="<?php echo $value["to"] ?>"><br><br>
				<span>Date: </span><input type="date" name="date" value="<?php echo date("Y-m-d"); ?>" ><br><br><br><br><br>
				<span>Duration: </span><input type="text" name="duration" placeholder="No of Mins" value="<?php echo $value["duration"] ?>"><br><br>
				<input type="submit" name="call" value="Submit" class="btn btn-success"><br>
			</form>
		</fieldset>

	<?php } elseif($typeOfAutomation=="Appointment" or $flag=="appointment") {?>
		<br><br><br>
		<span>Please input the below fields to proceed.</span><br>
		<br>
		<fieldset width="100">
			<legend>Appointment</legend>
			<form action="<?php if($checkAllGood==0)echo "action.php?q=appointment" ?>" method="post">
				
				<span>Date: </span><input type="date" name="date" value="<?php echo date("Y-m-d"); ?>" ><br><br><br>
				<span>Email: </span><input type="email" name="email" placeholder="Email Address" value="<?php echo $value["email"] ?>"><br><br>
				<input type="submit" name="appointment" value="Submit" class="btn btn-success"><br>
			</form>
		</fieldset>

	<?php } elseif($typeOfAutomation=="Reset") { ?>
		<span></span>
	<?php } ?>
	<?php
		//error tags
		foreach ($error as $key => $value) {
			if(strlen($value)!=0)
			echo $value."</br>" ;

		}
	 ?>
</body>
</html>