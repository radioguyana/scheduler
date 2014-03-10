<?php 

	//Connect to the database 
	$link = mysqli_connect("localhost", "root", "root", "scheduler");

	if (mysqli_connect_errno()) {
    	printf("Connect failed: %s\n", mysqli_connect_error());
    	exit();
	}else{
		//printf("Safe to assume we connected aight\n");
		$date = new DateTime();
		$current =  $date->getTimestamp();
	
		$query = "SELECT EV.* FROM `events` EV RIGHT JOIN `events_meta` EM1 ON EM1.`event_id` = EV.`id` WHERE (( $current - repeat_start) % repeat_interval = 0 )";

		$result = mysqli_query($link, $query);

		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
		    	echo $row['name'] . '<br />';
	    	}
		}else {
			echo "Studio One!";
		}
		

	}

	mysqli_close($link);
?>