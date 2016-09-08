<?php

use TodoPago\Sdk as Sdk;

require_once (dirname(__FILE__) . '/../vendor/autoload.php');
require_once(dirname(__FILE__).'/../../../../../../wp-blog-header.php');
//require_once(dirname(__FILE__).'/../TodoPago/lib/Sdk.php');
http_response_code(200);

$http_header = getHttpHeader();

$connector = new Sdk($http_header, get_option('todopago_environment'));

//opciones para el método getStatus 
$optionsGS = array('MERCHANT'=>getMerchant(),'OPERATIONID'=>$_GET['order_id']);
$status = $connector->getStatus($optionsGS);

$rta = '';

$refunds = $status['Operations']['REFUNDS'];


  $auxArray = array(
         "REFUND" => $refunds
         );

  if($refunds != null){  
      $aux = 'REFUND'; 
      $auxColection = 'REFUNDS';
  }


  if (isset($status['Operations']) && is_array($status['Operations']) ) {
      
        foreach ($status['Operations'] as $key => $value) {
            $rta .= "<tr>";  

            if(is_array($value) && $key == $auxColection){
                $rta .= "<td>$key: </td>";
                foreach ($auxArray[$aux] as $key2 => $value2) {               
                    $rta .= '<td>'.$aux."</td>";                
                    if(is_array($value2)){                    
                        foreach ($value2 as $key3 => $value3) {
                            if(is_array($value3)){                    
                                 foreach ($value3 as $key4 => $value4) {
                                    $rta .= "<tr><td>- $key4:</td><td> $value4 </td></tr>";
                                }
                            }else{
                                $rta .= "<tr><td>- $key3:</td><td> $value3 </td></tr>"; 
                            }                     
                        }
                    }else{
                      $rta .= "<tr><td>- $key2: </td><td> $value2 </td></tr>";
                    }
                }                        
            }else{  
                if(is_array($value) ){
                    $rta .= (!empty($value))? "<td>$key:</td><td>". var_export( $value ,true) ."</td>" : "<td>$key:</td><td> - </td>";                
                }else{
                    $rta .= "<td>$key:</td><td> $value </td>";
                }
            }

            $rta .= "</tr>";
        }
   }else{
       $rta .= 'No hay operaciones para esta orden.';
   }

//echo($rta);
?> 

<html>
<body>
<head>
<style>
img {
  padding: 7px;
}
h3 {
    font-size: 25px;
    font-style: courier;
    color: #333;
    padding: 7px;
  }

table, td, th {
border: 1px solid #ddd;
text-align: left;
}

table {
border-collapse: collapse;
width: 100%;
}

th, td {
font-size: 13px;  
padding: 7px;
}

tr:hover { background-color: #f5f5f5 }

</style>
</head>
<img src="http://www.todopago.com.ar/sites/todopago.com.ar/files/logo.png">
<h3>Estado de la operacion - TodoPago </h3>
<table><?php echo $rta ?></table>
</body>
</html>
