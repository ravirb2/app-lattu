<?php

$brand_category=$_GET['brand_category'];
  $connection = mysqli_connect("3.17.49.11", "bfcm", "Zaqxsw123jhytredknrs", "bfcm");

  if($brand_category!='None'){

    $query = mysqli_query($connection,
           "SELECT 
                *

            FROM (SELECT * FROM `amazon_lbb_transaction` WHERE DATE(created_on) = DATE(NOW()) AND HOUR(created_on) = HOUR(NOW())-1 ) b LEFT JOIN (SELECT * FROM `master_asin` WHERE STATUS = 1 ) a ON b.asin = a.web_pid WHERE a.`brand_category` ='".$brand_category."'");
}
else{
  $query = mysqli_query($connection,
           "select *
            FROM (SELECT * FROM `amazon_lbb_transaction` WHERE DATE(created_on) = DATE(NOW()) AND HOUR(created_on) = HOUR(NOW())-1 ) b LEFT JOIN (SELECT * FROM `master_asin` WHERE STATUS = 1 ) a ON b.asin = a.web_pid");
};
  $someArray = [];

  while ($row = mysqli_fetch_array($query)) {
    array_push($someArray, [
      'asin'  => $row['asin'],
'asin_name' => $row['asin_name'],
'brand' => $row['brand'],
'asin_type' => $row['asin_type'],
'position'  => $row['position'],
'bb_holder' => $row['bb_holder'],
'seller_name' => $row['seller_name'],
'seller_type' => $row['seller_type'],
'price_sp'  => $row['price_sp'],
'price_1p'  => $row['price_1p'],
'price_2p'  => $row['price_2p'],
'price_3p'  => $row['price_3p'],
'variance_calc' => $row['variance_calc'],
'pdp_page_url'  => $row['pdp_page_url'],
'created_on'  => $row['created_on'],
'hour'  => $row['hour'],
'time_split'  => $row['time_split'],
'is_fba'  => $row['is_fba'],
'cart_quantity' => $row['cart_quantity'],
'seller_name_pdp' => $row['seller_name_pdp'],
'brand_category'  => $row['brand_category'],
'lbb_flag_batch'  => $row['lbb_flag_batch'],
'Text1' => $row['Text1'],
'Text2' => $row['Text2'],
'Text3' => $row['Text3'],
'Text4' => $row['Text4'],
'Text5' => $row['Text5'],
'Text6' => $row['Text6'],
'Text7' => $row['Text7'],
'Text8' => $row['Text8'],
'Text9' => $row['Text9'],
'Text10'  => $row['Text10']

    ]);
  }
  // while ($row = mysqli_fetch_array($query)) {
  //   array_push($someArray, [
     
  //    key => $row['value']

  //   ]);
  // }

  $someJSON = json_encode($someArray);
  echo $someJSON;



  
?>