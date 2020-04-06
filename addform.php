<?php
//including the database connection file
include_once("classes/Crud.php");
$title="Add Form";
include_once("header.php");

$crud = new Crud();

//fetching data in descending order (lastest entry first)
$query = "SELECT * FROM gender ORDER BY id ASC";

$resultnew = $crud->getData($query);
?>
<html>
<head>
    <title>Add Data</title>
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
    <a href="index.php" class="btn btn-primary">Home</a>
    <br/><br/>
    <div id="msg"></div>
    <div class="row">
        <div class="col-md-4">
            <form action="add.php" method="post" name="form1" onsubmit="return (document.form1.first_name.value.length >= 3);">
                <table width="25%" class="table">
                    <tr> 
                        <td>Firstname</td>
                        <td><input class="form-control" type="text" name="first_name" required></td>
                    </tr>
                    <tr> 
                        <td>Lastname</td>
                        <td><input class="form-control" type="text" name="last_name" required></td>
                    </tr>
                    <tr> 
                        <td>Town</td>
                        <td><input class="form-control" type="text" name="town_name" required></td>
                    </tr>
                    <tr> 
                        <td>Gender</td>
                        <td><select class="form-control" name="gender_id" required>
                            <?php
                            foreach ($resultnew as $key => $res) {
                                $gender_Value=$res["id"];
                                echo '<option value="'.$gender_Value.'">'.$res["gender_name"].'</option>';
                            }
                                
                            ?>
                            
                        </select></td>
                    </tr>
                    <tr> 
                        <td></td>
                        <td><input type="submit" name="Submit" value="Add"  class="btn btn-success" onclick="validate()"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    
</body>
</html>

