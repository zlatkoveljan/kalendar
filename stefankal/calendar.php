<?php
session_start();

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "dbtasks";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
$servername = "localhost";
$username = "root";
$password = "";
$datab = array();
try {
    $conn = new PDO("mysql:host=$servername;dbname=dbtasks", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

    $stmt = $conn->prepare("SELECT id, dayd, hour, note, priorityt FROM tasks");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //print_r($result);die;
    foreach($stmt->fetchAll() as $k=>$v) {
        array_push($datab, $v);
    }
//print_r($datab);die;
// $conn = null;
// $data = array();
// $datab = array();
// $query = " SELECT * FROM tasks ";
// $result = mysqli_query($conn, $query);
// if (mysqli_num_rows($result) > 0) {
//     // output data of each row
//     while($row = mysqli_fetch_assoc($result)) {
//        // echo "id: " . $row["id"]. " - Note: " . $row["name"]. " " . $row["dayd"]. "<br>";
//         array_push($datab,$row); 
//     }
// } else {
//     echo "0 results";
// }

//print_r($datab); die;

//$conn->close();
//dovde za konekcija so baza i za vnes elementi i select all od baza



//  if(isset($_SESSION['data'])){
//      $data = $_SESSION['data'];
//      //print_r($data);die;
//  }else {
//     $data = array();
//     for($i=1; $i<6; $i++) {
//         for ($j=0; $j<9; $j++) {

//             $data[$i][$j]['priorityt'] = "";
//             $data[$i][$j]['note'] = "";
//             //print_r($data);DIE;
//         }
//     }
// }

//print_r($data);die;



if(isset($_POST['add_task'])){

    $day = $_POST['day'];
    $hour = $_POST['hour'];
    $priorityt = $_POST['priorityt'];
    $note = $_POST['note'];

    $data[$day][$hour]['priorityt'] = $priorityt;
    $data[$day][$hour]['note'] = $note;

    $_SESSION['data'] = $data;
    $usernamet = $_SESSION['username'];
    //print_r($_SESSION); die;
    $sql = "INSERT INTO tasks (dayd, hour, priorityt, note)
    VALUES ('$day', '$hour', '$priorityt', '$note')";
    //print_r($_POST);die;
    if ($conn->query($sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
}

//getting from db
 $stmt = $conn->prepare("SELECT id, dayd, hour, note, priorityt FROM tasks");
    $stmt->execute();
 $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    //print_r($result);die;
 $datab = array();
    foreach($stmt->fetchAll() as $k=>$v) {
        array_push($datab, $v);
    }
}

// //////
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "dbtasks";






?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bare - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        padding-top: 70px;
        /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
    }
    .hour{
        background: #C5C5C5;
        font-weight: bold;
        text-align: center;
        padding: 8px 2px !important;
    }
    tr,td{
        text-align: center;
    }
    td{
        border: 1px solid #ddd !important;
    }
    footer{
        background: #C5C5C5;
        font-weight: bold;
        text-align: center;
        padding: 8px 2px !important;   
    }
    a[title="logout"] {
        color: #222222;
        text-decoration: none;
    }
    .btn {
        background-color: #C5C5C5;
    }

    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Start Bootstrap</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="logout.php" title="logout">Logout</a>
                    </li>
                   
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1><?php echo $_SESSION['username']; ?> todo list</h1>
                
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-box">
                <div class="form-top">
                    <div class="form-top-left">
                        <h3>Task Form</h3>
                    </div>
                    <div class="form-top-right">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>
                <div class="form-bottom">
                    <form role="form" action="" method="post" class="login-form">
                        <div class="form-group">
                          <label class="" for="">Day:</label>
                            <select class="selectpicker" name="day">
                              <option value="1">Monday</option>
                              <option value="2">Tuesday</option>
                              <option value="3">Wednesday</option>
                              <option value="4">Thursday</option>
                              <option value="5">Friday</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label class="" for="">Hour:</label>
                            <select class="selectpicker" name="hour">
                              <option value="0">09</option>
                              <option value="1">10</option>
                              <option value="2">11</option>
                              <option value="3">12</option>
                              <option value="4">13</option>
                              <option value="5">14</option>
                              <option value="6">15</option>
                              <option value="7">16</option>
                              <option value="8">17</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label class="" for="">Priority:</label>
                            <select class="selectpicker" name="priorityt">
                              <option value="0">Danger</option>
                              <option value="1">Success</option>
                              <option value="2">Info</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-text">Task Name:</label>
                            <input type="text" class="form-text form-control" id="form-text" name="note">
                        </div>
                        <button type="submit" class="btn" name="add_task">Add Task</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th></th>
                    <th>Monday</th>
                    <th>Tusday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $tempvar = false;
                $br = 0;
               // print_r($datab);die;
                for($i=0; $i<9; $i++){
                    //echo "<tr>";
                    for($j=0; $j<6; $j++){
                        //echo $j . '</br>';
                        if($j==0) {
                            echo "<td class='hour'>" . ($i+9) . "</td>";
                            continue;
                        } else  {
                            $tempvar = false;
                        }
                       //print_r($datab); die;
                            foreach ($datab as $d) {
                                //print($d['hour'] . $d['note'] . '</br>');
                               //echo "<td class='" . $d ->$priorityt."'>" . $data[$j][$i]['note'] . "</td>";
                                if ((int)$d['hour'] === $i && (int)$d['dayd'] === $j)
                                {
                                    echo "<td class='" . $d['priorityt'] . "'>" . $d['note'] . "</td>";
                                    $tempvar = TRUE;
                                    $br ++;
                                    if ($br > 1){
                                        break;
                                    }
                                }
                                // else {
                                //     echo "<td></td>";
                                // }
                            }
                            if ( !$tempvar ){
                                echo "<td></td>";
                            }
                        }
                         echo "</tr>";
                    }
                   
               // }
                ?>
                </tbody>
              </table>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>
<footer><a href="logout.php" title="logout">Logout</a></footer>

</html>
