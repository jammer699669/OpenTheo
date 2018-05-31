<?
include('config2.php');



$con2 = new mysqli($it_db_host, $it_db_user, $it_db_pwd,$it_db_name); //connect to MySql
if ($con2->connect_error) {//Output any connection error
    die('Error : ('. $con2->connect_errno .') '. $con2->connect_error);
}
$tword=$_POST['tword'];
$querysub = "select * from theo where tkey ='$tword'";
$resultSub = mysqli_query($con2,$querysub) or die(mysqli_error($con2)) ;
  if(mysqli_num_rows($resultSub)>=1)
  {

    //$output[];
    while ($getvalue = mysqli_fetch_array($resultSub) )
      {

      $id=$getvalue["id"];
       $key=$getvalue["tkey"];
        $ttype=trim($getvalue["ttype"]);
         $syn=$getvalue["tsyn"];
         $ant=$getvalue["tant"];

         echo "<h3>".$key ."</h3> $id <br>";


         if ($ttype<>""){
              //echo $ttype."<br>";
              switch ($ttype){
                case "-n":
                echo $ttype." Noun <br>";

                break;
                case "-v":
                echo $ttype." Verb <br>";

                break;
                case "-adj":
                echo $ttype." Adjective <br>";

                break;
                case "-a":
                echo $ttype." Adjective <br>";

                break;



              }

         }
         //echo $tsyn."<br>";
         //echo $tant."<br>";
         ?>
         <div class="callout secondary">
           <center>SYN</center><br>
           <?=$syn?>
         </div>
         <div class="callout success">
            <center>ANT</center><br>
            <?=$ant?>
         </div>


         <?


       }
     }




?>
