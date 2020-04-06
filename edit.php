<?php
// including the database connection file
include_once("classes/Crud.php");
$title="Edit Form";
include_once("header.php");

$crud = new Crud();

//getting id from url
$id = $crud->escape_string($_GET['id']);

//selecting data associated with this particular id
$result = $crud->getData("SELECT * FROM customer WHERE id=$id");

foreach ($result as $res) {
    $first_name = $res['first_name'];
    $last_name = $res['last_name'];
    $town_name = $res['town_name'];
    $gender_id = $res['gender_id'];
}

$query = "SELECT * FROM gender ORDER BY id ASC";

$resultnew = $crud->getData($query);
?>
<html>
<head>  
    <title>Edit Data</title>
     <script type="text/javascript">
        function validate() {
            if (document.form1.first_name.value == '') {
                alert('Firstname is required');
                document.form1.first_name.focus();              
                return false;
            }
            if(document.form1.first_name.value.length<3)
            { 
                alert("The minimum length allowed in the first name is 3 characters");
                return false;
            }
            if (document.form1.last_name.value == '') {
                alert('Lastname is required');
                document.form1.last_name.focus();
                return false;
            }
            if (document.form1.town_name.value == '') {
                alert('Town name is required');
                document.form1.town_name.focus();
                return false;
            }
            if (document.form1.gender_id.value == '') {
                alert('Gender is required');
                document.form1.gender_id.focus();
                return false;
            }
            return true;
        }
    </script>   
</head>

<body>
    <a href="index.php"  class="btn btn-primary">Home</a>
    <br/><br/>
    <div class="row">
        <div class="col-md-4">
            <form name="form1" method="post" action="editaction.php" onsubmit="return (document.form1.first_name.value.length >= 3)">
                <table class="table">
                    <tr> 
                        <td>Firstname</td>
                        <td><input class="form-control" type="text" name="first_name" value="<?php echo $first_name;?>" required></td>
                    </tr>
                    <tr> 
                        <td>Lastname</td>
                        <td><input class="form-control" type="text" name="last_name" value="<?php echo $last_name;?>" required></td>
                    </tr>
                    <tr> 
                        <td>Town</td>
                        <td><input class="form-control" type="text" name="town_name" value="<?php echo $town_name;?>" required></td>
                    </tr>

                    <tr> 
                        <td>Gender</td>
                        <td><select  class="form-control" name="gender_id" required>
                            <?php
                            foreach ($resultnew as $key => $res) {
                                $gender_Value=$res["id"];
                                if ($gender_Value===$gender_id) {
                                    # code...
                                    echo '<option value="'.$gender_Value.'">'.$res["gender_name"].'</option>';
                                } else {
                                    echo '<option value="'.$gender_Value.'">'.$res["gender_name"].'</option>';
                                }
                            }
                                
                            ?>
                            
                        </select></td>
                    </tr>
                    <tr>
                        <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                        <td><input type="submit" name="update" value="Update"  class="btn btn-success" onclick="validate()"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    
</body>
</html>
