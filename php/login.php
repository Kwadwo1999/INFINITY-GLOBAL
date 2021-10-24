


<!--   
*    Title: PHP Login
*    Author: Dr Alena Denisova
*    Date: 2021
*    Availability: https://moodle.city.ac.uk/course/view.php?id=36436 -->






<?php
    if(!isset($_SESSION)) {
        session_start(); // start the session if it still does not exist
    }

   // connect to the database
	$conn = new mysqli('smcse-stuproj00.city.ac.uk', 'adbt207', '200020586', 'adbt207'); 
    if ($db->connect_errno) {
        printf("Connection failed: %s\n", $db->connect_error);
        exit();
    } else {
        // declare variables containing values from the input fields of the login form
        //the values come from the *name* attributes of the input fields
        $userLogin = $_POST['Login-Username'];
        $userPass = $_POST['Login-Password'];

        // select the username and password fields which match the data entered in the input fields
        $query = "SELECT Username, Password FROM Registration WHERE Username = '$userLogin' AND Password = '$userPass'";
        // execute the query
        $result = $conn->query($query);
        // store the results in $row variable
        $row = mysqli_fetch_row($result);

        // if $row returned no results from the query, then create a javascript alert
        if (!isset($row[0]) || !isset($row[1])) {
            // this will alert the user and then redirect to the specified page (Change the URL)
            echo "<script language='javascript'>
                    alert('Please enter valid credentials.');
                    window.location.href = 'https://smcse.city.ac.uk/student/adbt207/login.html';
                  </script>";
        }
        // if there is a match then activate a custom session called 'username' which allows access to a new web page called appointments
        else if ($userLogin == $row[0] && $userPass == $row[1]) {
            $_SESSION['Login-Username'] = $userLogin;



             // then redirect the user to the same page and log in (change to appropriate URL)
             echo "<script language='javascript'>
             alert('Welcome $userLogin!')
             window.location.href = 'https://smcse.city.ac.uk/student/adbt207/booking.html';
             </script>";
        }
    }
?>
