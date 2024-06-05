<?php 

require_once "../modelos/Pagos.php";

$pagos=new Pagos();

$id=isset($_POST["id"])? $_POST["id"]:"";
$deudor=isset($_POST["deudor"])? $_POST["deudor"]:"";
$cuota=isset($_POST["cuota"])? $_POST["cuota"]:"";
$cuotacapital=isset($_POST["cuotacapital"])? $_POST["cuotacapital"]:""; // Nuevo campo
$fechapago=isset($_POST["fechapago"])? $_POST["fechapago"]:""; // Nuevo campo

switch ($_GET["op"]){
	case 'guardar':
		
			$rspta=$pagos->insertar($id,$deudor,$cuota,$cuotacapital,$fechapago); // Modificar la llamada a la función insertar
			if (intval($rspta)==1){
				echo "pagos agregado";
			}
			if (intval($rspta)==1062){
				echo "Código de pagos repetido";
			}
			break;

		case 'editar':
			$rspta=$pagos->editar($id,$deudor,$cuota,$cuotacapital,$fechapago); // Modificar la llamada a la función editar
			echo $rspta ? "pagos actualizado" : "pagos no se pudo actualizar";
		
			break;

		case 'eliminar':
			$rspta=$pagos->eliminar($id);
			echo $rspta ? "pagos eliminado" : "pagos no se pudo eliminar";
		
			break;

	case 'mostrar':
		$rspta=$pagos->mostrar($id);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	
	case 'listar':
		$rspta=$pagos->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>$reg->id,
 				"1"=>$reg->deudor,
				"2"=>$reg->cuota,
				"3"=>$reg->cuotacapital, 
				"4"=>$reg->fechapago, // Nuevo campo
 				"5"=>'<button class="btn btn-primary" onclick="mostrar(\''.$reg->id. '\')"><i class="bx bx-search"></i>&nbsp;Seleccionar</button>'
 			);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data
		);
 		echo json_encode($results);

	break;
}
