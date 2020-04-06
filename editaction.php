<?php
// including the database connection file
include_once("classes/Crud.php");
include_once("classes/Validation.php");

$crud = new Crud();
$validation = new Validation();

if (isset($_POST['update'])) {
    $id = $crud->escape_string($_POST['id']);

    $first_name = $crud->escape_string($_POST['first_name']);
    $last_name = $crud->escape_string($_POST['last_name']);
    $town_name = $crud->escape_string($_POST['town_name']);
    $gender_id = $crud->escape_string($_POST['gender_id']);
    
    $msg = $validation->check_empty($_POST, array('first_name', 'last_name', 'town_name','gender_id'));
    /*$check_age = $validation->is_age_valid($_POST['age']);
    $check_email = $validation->is_email_valid($_POST['email']);*/
    
    // checking empty fields
    if ($msg) {
        echo $msg;
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {
        //updating the table
        $result = $crud->execute("UPDATE customer SET first_name='$first_name',last_name='$last_name',town_name='$town_name',gender_id='$gender_id' WHERE id=$id");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location: index.php");
    }
}
