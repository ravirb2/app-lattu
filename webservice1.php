<?php 


$requestData= $_REQUEST;
$connection = mysqli_connect("3.17.49.11", "bfcm", "Zaqxsw123jhytredknrs", "bfcm");


$sql = "SELECT * from amazon_lbb_transaction ";

$query=mysqli_query($connection, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData; 




if (@$requestData['date_range'] !='')
{
	if (@$requestData['date_range'] = 'daily'){
		$sql1.="  DATE(created_on) = DATE(NOW()) AND HOUR(created_on) = HOUR(NOW())-1 ";
	}
	elseif (@$requestData['date_range'] = 'monthly')
	{
		$sql1.=" DATE(`created_on`) BETWEEN  DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND  CURDATE()  ";
	}
	elseif (@$requestData['date_range'] = 'weekly'){
		$sql1.=" DATE(`created_on`) BETWEEN  DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND  CURDATE()  ";
	}
	else {
		$sql1.=" DATE(created_on) = DATE(NOW()) AND HOUR(created_on) = HOUR(NOW())-1 ";
	}

}



$sql = "SELECT * FROM (SELECT * FROM `amazon_lbb_transaction` WHERE '".$sql1."' ) b LEFT JOIN (SELECT * FROM `master_asin` WHERE STATUS = 1 ) a ON b.asin = a.web_pid WHERE 1=1";

if (@$requestData['brand_category'] !='')
{
	if (@$requestData['brand_category'] = 'VMS'){
		$sql.="and a.`brand_category` ='VMS'";
	}
	elseif (@$requestData['brand_category'] = 'HRW'){
		$sql.="and a.`brand_category` ='HRW'";
	}
	elseif (@$requestData['brand_category'] = 'IFCN'){
		$sql.="and a.`brand_category` ='IFCN'";
	}else {
		$sql.="and a.`brand_category` in ('IFCN','VMS','HRW')";
	}
}

// $sql.="limit '".$limit."'";

print_r($sql);
$query=mysqli_query($connection, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;
$query=mysqli_query($connection, $sql);

$data = array();
while ($row = $row=mysqli_fetch_array($query)) {
    array_push($data, [
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

$json_data = array(
	// "draw"            => intval( $requestData['draw'] ),
	"recordsTotal"    => intval( $totalData ),
	"recordsFiltered" => intval( $totalFiltered ),
	"data"            => $data
);

echo json_encode($json_data);