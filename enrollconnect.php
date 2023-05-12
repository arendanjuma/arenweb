<html>
    <head>
        <style>
            #demo{
                position: absolute;
                top: 0em;
                left: 60em;
            }
            table, tr, th, td{
                border: 1px solid black;
                color: indigo;
                margin-left: 18em;
            }
            th{
                font-size: x-large;
                color: green;
                text-transform: capitalize;
                text-align: center;
                background-color: pink;
            }
            h2{
                text-align: center;
                color: purple;
            }
            h4{
                text-align: center;
            }
            p{
                border: 0px solid black;
                background-color: lightgreen;
                color: white;
                width: 12em;
            }
            body{
                background-color: lightblue;
            }
            </style>
</head>
<body>
<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$telnumber = $_POST['telnumber'];
$location = $_POST['location'];
$age = $_POST['age'];
$course = $_POST['course'];

//Dabase connection
$conn = new mysqli('localhost', 'root', '', 'enroll_form');
if($conn->connect_error){
die('Connection Failed :'.$conn->connect_error);
}else{
    $stmt = $conn->prepare("insert into enrollment(firstname, lastname, email, telnumber, location, age, course) values(?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $firstname, $lastname, $email, $telnumber, $location, $age, $course);
    $stmt->execute();
    echo "<h4>Registration is successful....</h4>";
    echo "<h4>Print a copy for yourself</h4>";
    $stmt->close();
    $conn->close();
}


?>

<b id="demo">
<script>
var d = new Date();
document.getElementById("demo").innerHTML = d.toUTCString();
</script>
</b>

<p>
   Return to <a href="enrollmentform.html">Registration Form</a>
</p>

<table>
    <h2>ENROLLMENT FORM</h2>
            <tr>
                <th>id</th>
                <th>firstname</th>
                <th>lastname</th>
                <th>email</th>
                <th>telnumber</th>
                <th>location</th>
                <th>age</th>
                <th>course</th>
            </tr>
            <?php
            $conn = mysqli_connect("localhost", "root", "", "enroll_form");
            if($conn-> connect_error){
                die("Connection failed:". $conn-> connect_error);
            }
            $sql = "SELECT id, firstname, lastname, email, telnumber, location, age, course from enrollment";
            $result = $conn-> query($sql);

            if($result-> num_rows > 0){
                while($row = $result-> fetch_assoc()){
                    echo "<tr><td>". $row["id"] ."</td><td>". $row["firstname"] ."</td><td>". $row["lastname"] ."</td><td>". $row["email"] ."</td><td>". $row["telnumber"] ."</td><td>". $row["location"] ."</td><td>". $row["age"] ."</td><td>". $row["course"] ."</td></tr>";
                }
                echo "</table>";
            }
            else {
                echo "0 result";
            }
            $conn-> close();
            ?>
        </table>
   
</body>
</html>