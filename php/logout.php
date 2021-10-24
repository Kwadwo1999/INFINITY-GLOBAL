
<!--   
*    Title: PHP LOG-OUT
*    Author: Dr Alena Denisova
*    Date: 2021
*    Availability: https://moodle.city.ac.uk/course/view.php?id=36436 -->


<?php
    session_start();
    unset($_SESSION['Username']); // disable the username session

    // end the session
    session_destroy();

     // then redirect the user to the login form 
     echo "<script language='javascript'>
     alert('Log out Successfully!')
     window.location.href = 'https://smcse.city.ac.uk/student/adbt207/login.html';
     </script>";

?>