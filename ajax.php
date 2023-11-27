<?php

if(isset($_GET['method'])){
$sch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://sitpas.depok.go.id");
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
$soutput = curl_exec($ch);
echo $output;
curl_close($ch);
}
?>