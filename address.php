<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Schools</title>
</head>

<body>
<?php
$dbc = mysqli_connect('host','username','password','dbname')
    or die('Error connecting to MySQL server.');

$query = "SELECT  `id`, `gs_id` ,  `name` ,  `state` ,  `country`
FROM  `school`";

$result = mysqli_query($dbc, $query)
    or die('Error querying database.');

$row = mysqli_fetch_array($result); ?>

<table>
    <thead>
        <tr>
            <td></td>
            <td>Name</td>
            <td>State</td>
            <td>Country</td>
            <td>Address</td>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_array($result)) {
                $name = $row['name'];
                $state = $row['state'];
                $country = $row['country'];
                $gsid = $row['gs_id'];
                $id = $row['id'];
                $xml = simplexml_load_file("http://api.greatschools.org/schools/".$state."/".$gsid."?key=YOUR_GREATERSCHOOLSAPI_KEY_HERE&address");
                $address = $xml->address;
                echo '<tr><td>'.$id.'</td><td>'.$row['name'].'</td><td>'.$row['state'].'</td><td>'.$row['country'].'</td><td>'.$address.'</td></tr>';
            }
        ?>
    </tbody>
</table>

<?php
mysqli_close($dbc);

?>

</body>
</html>
