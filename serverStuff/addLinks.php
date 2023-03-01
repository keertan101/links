<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

//echo "<pre>";
//var_dump($_POST);
//echo "</pre>";

function addToCsvFromPostRequest(){
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
}

addToCsvFromPostRequest();
echo "The Data has been added to the csv file(database)";

header("Location: ../index.html");
?>
