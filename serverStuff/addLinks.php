<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

//echo "<pre>";
//var_dump($_POST);
//echo "</pre>";

function addToCsv(){
  $timestamp = "";
  if(!empty($_POST["hours"])){
    $timestamp = str_pad($_POST["hours"], 2, "0", STR_PAD_LEFT);
  }else{
    $timestamp = "00";
  }

  $timestamp .= ":";
  if(!empty($_POST["mins"])){
    $timestamp .= str_pad($_POST["mins"], 2, "0", STR_PAD_LEFT);
  }else{
    $timestamp .= "00";
  }

  $timestamp .= ":";
  if(!empty($_POST["secs"])){
    $timestamp .= str_pad($_POST["secs"], 2, "0", STR_PAD_LEFT);
  }else{
    $timestamp .= "00";
  }

  //"ਮਾਈਚਰਨਗੁਰਮੀਠੇ ॥", "1:30", "http://sikhsoul.com/golden_khajana_files/mp3/Keertan/Bhai%20Mohinder%20Singh%20SDO/Maaee%20Charan%20Gur%20Meethae.mp3", "SDO Ji"
  $line = array($_POST["pangti"], $timestamp, $_POST["link"],$_POST["keertani"]);

  echo "<pre>";
  var_dump($line);
  echo "</pre>";

  $fp = fopen("./rawData.csv", "a");
  fputcsv($fp, $line); # $line is an array of strings (array|string[])
  fclose($fp);
  echo "The Data has been added to the csv file(database)";
}

function makeDataToJs($file){
  $objLst = array();
  $postNum = 0;
  if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $postNum+=1;
      $obj['pangti']=$data[0];
      $obj['time']=$data[1];
      $obj['link']=$data[2];
      $obj['postNum']=$postNum;
      $obj['keertani']=$data[3];
      array_push($objLst,$obj);
    }
    fclose($handle);
  }
  return json_encode($objLst);
}

addToCsvFromPostRequest();
$jsObj = makeDataToJs("./rawData.csv");
$myFile = fopen("./data.js", "w");
fwrite($myFile,"const DATA = ");
fwrite($myFile,$jsObj);
echo "Made Js Obj";

//header("Location: ./data.js");
?>
