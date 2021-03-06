<?php
	if(session_id() == ''){
			session_start();
	}
	require "db_library.php"; //PHP file where the database proccessing is actually done

	/*$_POST["room_checkindate"] and $_POST["room_checkoutdate"] were retrived from
	the POST request made in book_post.js. "select_room(datein, dateout, pax)" is a
	function from db_library, it returns an array with the available rooms or 0 if there is any.*/

	$sqldatein=date('Ymd',strtotime($_POST["room_checkindate"]));
	$sqldateout=date('Ymd',strtotime($_POST["room_checkoutdate"]));

	$results = select_room($sqldatein, $sqldateout, $_POST["room_pax"]);
	if (count ($results)>0){
		echo json_encode($results, JSON_FORCE_OBJECT); //converts the result from array to JSON
	}
	else{
		echo 0;
	}
	//closing database connection
	$mysqli -> close();
?>
