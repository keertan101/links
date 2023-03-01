<?php
header("Access-Control-Allow-Origin: *");

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
  echo json_encode($objLst);
}

makeDataToJs("./rawData.csv");

?>
