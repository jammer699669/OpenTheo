<?
/*
Independent Technical Services
* Not for a production envoirment
* Must be hardened and more error correction and detection added
* 
* */
include('headert.php');
include('config2.php');


global $con2;
$con2 = new mysqli($it_db_host, $it_db_user, $it_db_pwd,$it_db_name); //connect to MySql
if ($con2->connect_error) {//Output any connection error
    die('Error : ('. $con2->connect_errno .') '. $con2->connect_error);
}
function checkData($word){
global $con2;
$querysub = "select * from theo where tkey ='$word' limit 1";
$resultSub = mysqli_query($con2,$querysub) or die(mysqli_error($con2)) ;
  if(mysqli_num_rows($resultSub)>=1)
  {
    return 1;

  }else{
    return 0;
    }



}

$discardw=array('the','be','but','and','if','then','for');

				
?>

<header>
  <script src="ajaxword.js"></script>
  <? include('topbar.php'); ?>
  <!-- logo and ad break -->
  <br>
  <article class="grid-container">
    <div class="grid-x grid-margin-x">
      <div class="medium-4 cell">

        <img alt="The Theo Project" longdesc="The Theo Project Open Source Thesaurus" src="img/ttp-l1-logo.png">
      </div>
      <div class="medium-8 cell">
       <div class="callout primary center">
       <div class="text-center">
      <h4> The Theo Project</h4>
       Open Source Thesaurus Database
       </div>

       </div>
      </div>
    </div>
  </article>
  <!-- / logo and ad break -->
  <br>
  <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
    <button class="menu-icon" type="button" data-toggle></button>
    <div class="title-bar-title">Menu</div>
  </div>
  <div class="top-bar align-center" id="main-menu">
    <center>
    <ul class="menu vertical medium-horizontal medium-text-center" data-responsive-menu="drilldown medium-dropdown">
      <li>
        </li>


    </ul>
  </center>
  </div>
</header>
<br>
<article class="grid-container">
  <div class="grid-x grid-margin-x">
    <div class="medium-8 cell">
    <div class="callout">
<?
$outstring="";
if (isset($_POST['doitpara'])){
  $message=$_POST['para'];
  ?> <div class="callout"><?
  // now we take it apart
  //echo $message;
  // strip commas etc
  $newstring=str_replace("\r\n", "",$message);
  $newstring=str_replace("\n", "",$newstring);
  $newstring=str_replace("    ", " ",$newstring);
  $newstring=str_replace("   ", " ",$newstring);
  $newstring=str_replace(",", " ",$newstring);
  $newstring=str_replace('"', " ",$newstring);
  $newstring=str_replace('.', " . ",$newstring);


  $estring=explode(" ",$newstring);
  foreach($estring as $word){
$word=trim($word);
$tword=strtolower($word);
if (in_array($tword, $discardw))
{
//echo "Match  discard $word <br>";
  $outstring.=$word." ";
}else{

  // check to see if in Database
  $ck=checkData($word);
  if ($ck==1){
    // do link
//    echo "Found Word  $word<br>";
    // <a class="button expanded" href="#" onclick="ajaxRC('dorandom','0')">Generate Random</a>
  $outstring.="<a  href=\"#\" onclick=\"ajaxRC('results','$word')\">$word</a> ";
  $teststring=$outstring;
  }else{
//    echo "NOT Found   $word <br>";
$outstring.=$word." ";

  }
}


}
echo $outstring;
  ?>
</div>
  	<textarea name="para" cols="180" rows="25"><?=$message?></textarea><br>
    <?
}else{

?>

      <p>Paragraph </p>
      <form method="post" action="para.php">

      	<textarea name="para" cols="180" rows="25"></textarea><br>
        <input class="button large rounded" name="Submit1" type="submit" value=" SEND " />
      		<input name="doitpara" type="hidden" value="1">

      </form>
<?
} // end if set doitpara
?>






      </div>
    </div>
    <div class="medium-4 cell callout">
      <div id="results"></div>
      <br><br><br>
    </div>
  </div>
</article>
<hr>
<article class="grid-container">
  <div class="grid-x grid-margin-x">
    <div class="grid-x large-12 cell">
<div class="text-center">
  <h4 style="margin: 0;" class="text-center">BREAKING NEWS</h4>
  <div class="grid-x large-1#2 cell">
    WE are working hard getting the first database up and running. So far we are referencing over Eight Thousand words. Hopefully soon we will have the database ready for distribution.
  </div>
</div>
</div>
    <hr>
    <div class="grid-x large-12 cell">
      <div class="text-center">

  </div>




        </div>
      </div>

    </div>
</article>

<?
include('footert.php');
?>
