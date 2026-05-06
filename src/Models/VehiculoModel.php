<?php
namespace App\Models;

use PDO; // Importamos la clase PDO para manejar la conexión a la base de datos y ejecutar consultas SQL. PDO es una extensión de PHP que proporciona una interfaz segura y flexible para interactuar con bases de datos, permitiendo el uso de sentencias preparadas para prevenir ataques de inyección SQL.

class VehiculoModel { // Clase para manejar la lógica de acceso a datos relacionada con los vehículos. Esta clase se encarga de interactuar con la base de datos para obtener, insertar, actualizar o eliminar información sobre los vehículos. En este caso, se implementa un método leerTodos() que ejecuta una consulta SQL para obtener todos los registros de la tabla de vehículos y devuelve esa información en un formato que pueda ser utilizado por el controlador y la vista.
    private $conn; // Atributo privado para almacenar la conexión a la base de datos
    private $table_name = "vehiculos"; // El nombre de la tabla en gestion_alquiler.sql

    public function __construct($db) { // Constructor que recibe la conexión a la base de datos como parámetro. Esto permite que el modelo pueda interactuar con la base de datos para ejecutar consultas SQL y obtener los datos necesarios para el controlador y la vista.
        $this->conn = $db; // Asignamos la conexión a la base de datos al atributo $conn para que pueda ser utilizado en los métodos de esta clase para ejecutar consultas SQL y manejar los datos relacionados con los vehículos.
    }

    // Método para obtener todos los vehículos
    public function leerTodos() { // Método para obtener todos los vehículos disponibles en la base de datos. Este método ejecuta una consulta SQL para seleccionar todos los registros de la tabla de vehículos y devuelve esa información en un formato que pueda ser utilizado por el controlador y la vista.
        $query = "SELECT * FROM " . $this->table_name; // Construimos la consulta SQL para seleccionar todos los registros de la tabla de vehículos. El nombre de la tabla se obtiene del atributo $table_name, lo que permite que el código sea más flexible y fácil de mantener en caso de que el nombre de la tabla cambie en el futuro.
        $stmt = $this->conn->prepare($query); // Preparamos la consulta SQL utilizando el método prepare() de PDO. Esto permite que la consulta sea ejecutada de manera segura, evitando ataques de inyección SQL al utilizar sentencias preparadas. El resultado de prepare() es un objeto de tipo PDOStatement que se utiliza para ejecutar la consulta y obtener los resultados.
        $stmt->execute(); // Ejecutamos la consulta SQL utilizando el método execute() del objeto PDOStatement. Esto envía la consulta al servidor de la base de datos para que sea procesada y se obtengan los resultados correspondientes. En este caso, se espera que la consulta devuelva todos los registros de la tabla de vehículos.
        
        // Retorna un array asociativo con los datos
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}