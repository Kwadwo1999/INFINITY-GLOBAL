<!--   
*    Title: PHP REGISTER
*    Author: Dr Alena Denisova
*    Date: 2021
*    Availability: https://moodle.city.ac.uk/course/view.php?id=36436 -->


<?php
    // connect to the database
    //use your moodle student name both as the login (second parameter) and the name of the database you are connecting to (last parameter)
    //the password is your student id number, which is nine digits long as the third parameter - the password
	$conn = new mysqli('smcse-stuproj00.city.ac.uk', 'adbt207', '200020586', 'adbt207'); 
    if ($conn->connect_errno) {
        printf("Connection failed: %s\n", $conn->connect_error);
        exit();
    } else {
     // declare the variables for registration and assign values to these variables from the data entered by the user in the fields
        //these refer to the *name* attribute you gave to each input field in the form
        $username = $conn->real_escape_string($_POST['Username']);
        $firstName = $conn->real_escape_string($_POST['First-Name']);
        $lastName = $conn->real_escape_string($_POST['Last-Name']);
        $mobile = $conn->real_escape_string($_POST['Phone-Number']);
        $email = $conn->real_escape_string($_POST['Email']);
        $password = $conn->real_escape_string($_POST['Password']);

        $hashed_pword = md5($password); // encrypt the given password


        // this is for back-end form validation
        // query that selects the username field
        $query_username = "SELECT Username FROM Registration WHERE Username = '$username'";
        // execute the query
        $res_username = mysqli_query($conn, $query_username);

        // if the username entered by the user already exists, then create an alert and redirect to login page
        if (mysqli_num_rows($res_username) > 0) {
            echo "<script language='javascript'>
                    alert('Username already taken. Registration failed.');
                    window.location.href = 'https://smcse.city.ac.uk/student/adbt207/login.html';
                    </script>";
        }
        // if the username does not exist then...
        else {
            // insert values from the input fields to the database
            //username, fName, lName, mobile, email, password = names of columns you created in your database
            mysqli_query($conn, "INSERT INTO Registration (Username, FirstName, LastName, PhoneNumber, Email, Password)
            VALUES ('$username', '$firstName', '$lastName', '$mobile', '$email', '$password')")
                
            or die(mysqli_error($conn)); // cancel if there is an error

            // then redirect the user to the same page and log in (change to appropriate URL)
            echo "<script language='javascript'>
                    alert('Registered successfully!')
                    window.location.href = 'https://smcse.city.ac.uk/student/adbt207/login.html';
                    </script>";
        }
    }
?>
