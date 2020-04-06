<?php
//including the database connection file
include_once("classes/Crud.php");
$title="Home";
include_once("header.php");

$crud = new Crud();

//fetching data in descending order (lastest entry first)
$query = "SELECT c.id,c.first_name,c.last_name,c.town_name,
g.gender_name FROM customer c, gender g where c.gender_id=g.id ORDER BY id DESC";

$result = $crud->getData($query);
?>

<body>
<a href="addform.php" class="btn btn-success">Add New Data</a><br/><br/>

    <table class="table">

    <tr>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Gender</td>
        <td>Town</td>
        <td>Action</td>
    </tr>
    <?php
    foreach ($result as $key => $res) {
    //while($res = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>".$res['first_name']."</td>";
        echo "<td>".$res['last_name']."</td>";
        echo "<td>".$res['town_name']."</td>";
        echo "<td>".$res['gender_name']."</td>";
        echo "<td><a href=\"edit.php?id=$res[id]\" class=\"btn btn-info\">Edit</a> | <a href=\"delete.php?id=$res[id]\" class=\"btn btn-danger\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
    }
    ?>
    </table>
</body>
</html>
