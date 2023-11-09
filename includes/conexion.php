<?php
class SolarDB {
	private $host = 'dbsolar.database.windows.net,1433';
	private $dbname = 'dbsolar';
	private $username = 'adminsqlsolar';
	private $password = 'SolarSofttown2023.';
	private $conexion;

	public function connect() {
		try {
			$this->conexion = new PDO("sqlsrv:server={$this->host};database={$this->dbname};", $this->username, $this->password);
			$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $this->conexion;
		} catch (Exception $e) {
			echo 'Error en la conexión: ' . $e->getMessage();
			return false;
		}
	}
}
 ?>
