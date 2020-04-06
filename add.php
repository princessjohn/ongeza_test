<html>
<head>
    <title>Add Data</title>
</head>

<body>
<?php
//including the database connection file
include_once("classes/Crud.php");
include_once("classes/Validation.php");

$crud = new Crud();
$validation = new Validation();

if (isset($_POST['Submit'])) {
    $first_name = $crud->escape_string($_POST['first_name']);
    $last_name = $crud->escape_string($_POST['last_name']);
    $town_name = $crud->escape_string($_POST['town_name']);
    $gender_id = $crud->escape_string($_POST['gender_id']);
        
    $msg = $validation->check_empty($_POST, array('first_name', 'last_name', 'town_name','gender_id'));/*
    $check_age = $validation->is_age_valid($_POST['age']);
    $check_email = $validation->is_email_valid($_POST['email']);*/
    
    // checking empty fields
    if ($msg != null) {
        echo $msg;
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
        // if all the fields are filled (not empty)
            
        //insert data to database
        $result = $crud->execute("INSERT INTO customer (first_name,last_name,town_name,gender_id,is_deleted) VALUES('$first_name','$last_name','$town_name','$gender_id',0)");
        
        //display success message
        echo "<font color='green'>Data added successfully.";
        echo "<br/><a href='index.php'>View Result</a>";
    }
}
?>
</body>
</html>
