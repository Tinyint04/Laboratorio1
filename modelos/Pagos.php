
<?php 
// Incluimos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Pagos
{
	// Implementamos nuestro constructor
	public function __construct()
	{

	}

	// Implementamos un método para insertar registros
	public function insertar($id, $deudor, $cuota, $cuotacapital, $fechapago)
	{
		try {
			$sql = "INSERT INTO pagos (id, deudor, cuota, cuotacapital, fechapago)
			VALUES ('$id','$deudor','$cuota','$cuotacapital','$fechapago')";
			return ejecutarConsulta($sql);
		} catch (Exception $e) {
			return $e->getCode(); // Devuelve el código de error de la excepción
		}
	}

	// Implementamos un método para editar registros
	public function editar($id, $deudor, $cuota, $cuotacapital, $fechapago)
	{
		$sql = "UPDATE pagos SET deudor='$deudor', cuota='$cuota', cuotacapital='$cuotacapital', fechapago='$fechapago' WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	// Implementamos un método para eliminar registros
	public function eliminar($id)
	{
		$sql = "DELETE FROM pagos WHERE id='$id'";
		return ejecutarConsulta($sql);
	}

	// Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($id)
	{
		$sql = "SELECT * FROM pagos WHERE id='$id'";
		return ejecutarConsultaSimpleFila($sql);
	}

	// Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT * FROM pagos";
		return ejecutarConsulta($sql);		
	}
}

?>
