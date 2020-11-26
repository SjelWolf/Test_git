<?php
//open txt file
$file = fopen ("ventas.txt","r");
//file to array $array ignoring spaces
$array = file("ventas.txt", FILE_SKIP_EMPTY_LINES);
//close txt file
fclose($file);
//convert $array to multidiemnsional $array2  ignorando \t
$array2;
$array3;
for($i=0; $i < count($array); $i++){
  $array2[$i] = explode("\t", $array[$i]);
  //select all codes from $array2 and insert into $array3
  $array3[$i] = $array2[$i][0];
}

//insert into $arrayCodes unique codes exists
$arraycodes =  array_unique($array3);
//function to total all national sales
function nationalSales($codi,$array2){
  $value=0;
  for($i=0; $i < count($array2); $i++){
    if($codi ==$array2[$i][0]){
      if($array2[$i][4]=="N"){
        $value = $value + (int)$array2[$i][5];
      }
    }
  }
  return $value;
}
//function to total all international sales
function internationalSales($codi,$array2){
  $value=0;
  for($i=0; $i < count($array2); $i++){
    if($codi ==$array2[$i][0]){
      if($array2[$i][4]=="I"){
        $value = $value + (int)$array2[$i][5];
      }
    }
  }
  return $value;
}
//function to seller's commission
define ("PER1N",0.015);
define ("PER2N",0.035);
define ("PER1I",0.023);
define ("PER2I",0.045);
function porcent($cant, $typeofSale){

  if($typeofSale == "N"){
    if($cant <= 2000000){
      return PER1N;
    }else{
      return PER2N;
    }
  }else{
    if($cant <= 4000000){
      return PER1I;
    }else{
      return PER2I;
    }
  }
}
function nationalCommissions($codi,$array2){
  $value=0;
  for($i=0; $i < count($array2); $i++){
    if($codi ==$array2[$i][0]){
      if($array2[$i][4]=="N"){
        $value = $value + ((int)$array2[$i][5]*porcent($array2[$i][5],"N"));
      }
    }
  }
  return $value;
}

function internationalCommissions($codi,$array2){
  $value=0;
  for($i=0; $i < count($array2); $i++){
    if($codi ==$array2[$i][0]){
      if($array2[$i][4]=="I"){
        $value = $value + ((int)$array2[$i][5]*porcent($array2[$i][5],"I"));
      }
    }
  }
  return $value;
}
function vendorPayValue($codi,$array2){
return nationalCommissions($codi,$array2) + internationalCommissions($codi,$array2);
}
?>
