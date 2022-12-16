<?php
include 'dbh.php';
?>
<?php
    $FNG = "";
    $LNG = "";
    $Type = "";
    $Date = "";
    $LS = "";
    $OP = "";
    $queryResult = 0;

$sql = "SELECT * FROM ccdb_xls";
$result = mysqli_query($conn, $sql);
$queryResults = mysqli_num_rows($result);
?>

</div>

<div class = "lastname-container">
<html>
  
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Goofy Goober SearchBar</title>
  <link href="/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="title">
<h1>Clay County Museum Land History</h1>
<h3>Team Mando Prototype </h3>
</div>

  <div class="row">
<div class='breathing'> </div> <!-- Breathing room -->
  <div class="col-info"> <!--Left Column-->

<!------------------------------------------------------------------------------------------------------------------------------------->  
  <fieldset>
     <legend>Name Search</legend>
      <p>
          <label>Name Search:</label>
            <form method = "POST">
              <input type = "text" name = "search" placeholder="Search">
            <button type = "submit" name = "submit-search">Search</button>
            </form>
            <?php echo "There are " .$queryResult. " results!"; ?>
      </p>
    </fieldset>
  
    <div class = "lastname-container">
    <?php
        if (isset($_POST['submit-search'])){
            $search = mysqli_real_escape_string($conn, $_POST['search']);
            $sql = "SELECT * FROM ccdb_xls WHERE Last_Name_Grantor_1 LIKE '%$search%' OR First_Name_Grantor_1 LIKE '%$search%'";
            $result = mysqli_query($conn, $sql);
            $queryResult = mysqli_num_rows($result);


if ($queryResult > 0){
    while($row = mysqli_fetch_assoc($result)){
        //this is what displays as a result.
        $LNG =$row['Last_Name_Grantor_1'];
        $FNG = $row['First_Name_Grantor_1'];
        $LS = $row['SEC'];
        $OP = $row['LOT'];
    ;}
}else{
    echo "There are no results matching your search!";
}
        }

        if ($LNG === null) $LNG = "null";
        if ($FNG === null) $FNG = "null";
        if ($LS === null) $LS = "null";
        if ($OP === null) $OP = "null";
?>
</div>
<!-------------------------------------------------------------------------------------------------------------------------------------->
    <br>
    <fieldset>
     <legend>Landowner Information</legend>
      <p>
          <table>
  <tr>
    <th>Name</th>
    <th>Land Section</th>
    
    <th>Owned Plot</th>
  </tr>
  <tr>
    <td><?php echo "{$LNG} {$FNG}"; ?></td>
    <td><?php echo "{$LS}"?></td>
    <td><?php echo "{$OP}"?></td>
  </tr>
          </table>
      </p>
     <!-- <button>Clear Results</button> -->
    </fieldset>
</div>
     <br>
    
    <div class="col-map"> <!--Right Column-->
       <fieldset id='Map'>
     <legend>Map</legend>
      <script src="Map.js"></script>
          
    </fieldset>
      </div>

      <div class='breathing'> </div> <!-- Breathing room -->
  </div>  
</body>

<div class='footer'>
  <p>Ⓒ2022 Gamers Incorportated Limited</p>
</div>

<!--
<form action = "search.php" method = "POST">
    <input type = "text" name = "search" placeholder="Search">
<button type = "submit" name = "submit-search">Search</button>
</form>
-->
</div>

</body>
</html>

