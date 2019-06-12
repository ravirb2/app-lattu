<?php

$brand_category=$_GET['brand_category'];
  $connection = mysqli_connect("3.17.49.11", "bfcm", "Zaqxsw123jhytredknrs", "bfcm");

  if($brand_category!='None'){

    $query = mysqli_query($connection,
           "SELECT 
                
*
FROM (SELECT * FROM `amazon_lbb_transaction` WHERE DATE(created_on) = DATE(NOW()) AND HOUR(created_on) = HOUR(NOW())-1 ) b LEFT JOIN (SELECT * FROM `master_asin` WHERE STATUS = 1 ) a ON b.asin = a.web_pid WHERE a.`brand_category`
'".$brand_category."'");
}
else{
  $query = mysqli_query($connection,
           "SELECT 
*
FROM (SELECT * FROM `amazon_lbb_transaction` WHERE DATE(created_on) = DATE(NOW()) AND HOUR(created_on) = HOUR(NOW())-1 ) b LEFT JOIN (SELECT * FROM `master_asin` WHERE STATUS = 1 ) a ON b.asin = a.web_pid ");
};
  $someArray = [];

  while ($row = mysqli_fetch_assoc($query)) {
    array_push($someArray, [
      'asin'  => $row['asin'],
		'asin_name' => $row['asin_name'],
		'brand' => $row['brand'],
		'asin_type' => $row['asin_type'],
		'bb_holder' => $row['bb_holder'],
		'seller_name' => $row['seller_name'],
		'seller_type' => $row['seller_type'],
		'price_sp'  => $row['price_sp'],
		'price_1p'  => $row['price_1p'],
		'price_2p'  => $row['price_2p'],
		'price_3p'  => $row['price_3p'],
		'variance_calc' => $row['variance_calc'],
		'seller_name_pdp' => $row['seller_name_pdp'],
		'brand_category'  => $row['brand_category'],
		'lbb_flag_batch'  => $row['lbb_flag_batch']

    ]);
  }

  // $someJSON = json_encode($someArray);



  
$json_data = array(
      // "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
      // "recordsTotal"    => intval( $totalData ),  // total number of records
      // "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
      "data"            => $someArray   // total data array
      );


echo json_encode($json_data);
?>

