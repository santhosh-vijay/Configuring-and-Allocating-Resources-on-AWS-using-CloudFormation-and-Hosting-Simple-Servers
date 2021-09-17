<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Select Example</title>

</head>

<body>
<h1 align="center">Details</h1>
<table border="1" align="center" style="line-height:25px;">
<tr>
<th>Field</th>
<th>Type</th>
<th>Null</th>
<th>Key</th>
<th>Default</th>
<th>Extra</th>
</tr>

<?php

$connection=mysqli_connect("172.31.107.149","root","Letmein11@","details");
if ($connection) {
        echo "Connection Established! <br>";
} else {
        die("Connection failed. Reason: ".mysqli_connect_error());
}

$sql="SELECT * FROM pet";

if ($result=mysqli_query($connection, $sql)) {
        if (mysqli_num_rows($result) > 0) {
                while ($row=mysqli_fetch_array($result)) {
                        echo "Field :{$row["Field"]} <br>";
                        ?>
                        <tr>
                        <td><?php echo $row["Field"]; ?></td>
                        <td><?php echo $row["Type"]; ?></td>
                        <td><?php echo $row["Null"]; ?></td>
                        <td><?php echo $row["Key"]; ?></td>
                        <td><?php echo $row["Default"]; ?></td>
                        <td><?php echo $row["Extra"]; ?></td>
                        </tr>
                        <?php
                }
        }

}

else
{
        echo "Error: ".mysqli_error($connection);
        ?>
        <tr>
        <th colspan="2">There is no data found!</th>
        </tr>
        <?php
}

mysqli_close($connection)

?>
</table>

</body>

</html>

CREATE TABLE pet (name VARCHAR(20), owner VARCHAR(20),species VARCHAR(20), sex CHAR(1), birth DATE, death DATE);

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Select Example</title>

</head>

<body>
<h1 align="center">Details</h1>
<table border="1" align="center" style="line-height:25px;">
<tr>
<th>Field</th>
<th>Type</th>
<th>Null</th>
<th>Key</th>
<th>Default</th>
<th>Extra</th>
</tr>

<?php

$connection=mysqli_connect("10.0.2.32","santhosh","letmein1","details");
if ($connection) {
        echo "Connection Established! <br>";
} else {
        die("Connection failed. Reason: ".mysqli_connect_error());
}

$sql="SELECT * FROM pet";

if ($result=mysqli_query($connection, $sql)) {
        if (mysqli_num_rows($result) > 0) {
                while ($row=mysqli_fetch_array($result)) {
                        echo "Field :{$row["Field"]} <br>";
                        ?>
                        <tr>
                        <td><?php echo $row["Field"]; ?></td>
                        <td><?php echo $row["Type"]; ?></td>
                        <td><?php echo $row["Null"]; ?></td>
                        <td><?php echo $row["Key"]; ?></td>
                        <td><?php echo $row["Default"]; ?></td>
                        <td><?php echo $row["Extra"]; ?></td>
                        </tr>

                        <?php
                }
        }

}

else
{
        echo "Error: ".mysqli_error($connection);
        ?>
        <tr>
        <th colspan="2">There is no data found!</th>
        </tr>
        <?php
}

mysqli_close($connection)

?>
</table>

</body>

</html>
