<?php
namespace App\Controllers; // Namespace para organizar el código

// El modelo que sea crea aqui es para manejar la lógica de negocio relacionada con los vehículos, como acceder a la base de datos para obtener la lista de vehículos disponibles. El controlador se encarga de recibir las solicitudes del usuario, interactuar con el modelo para obtener los datos necesarios y luego pasar esos datos a la vista para que se muestren al usuario. En este caso, el controlador tiene un método listar() que llama al modelo para obtener todos los vehículos y luego devuelve esa información para ser utilizada en la vista.
use App\Models\VehiculoModel; // Importamos el modelo de Vehículo para poder usarlo en el controlador

class VehiculoController { // Clase para manejar la lógica de negocio relacionada con los vehículos
    private $model; // Atributo privado para almacenar la instancia del modelo de Vehículo

    public function __construct($db) { // Constructor que recibe la conexión a la base de datos como parámetro
        // Necesitaremos un Modelo para hablar con la base de datos // El modelo se encargará de ejecutar las consultas SQL y devolver los resultados al controlador
        $this->model = new VehiculoModel($db); // Creamos una nueva instancia del modelo de Vehículo, pasando la conexión a la base de datos para que el modelo pueda interactuar con ella. Esto permite que el controlador utilice el modelo para obtener los datos necesarios para la vista.
    }

    public function listar() { // Método para listar todos los vehículos disponibles
        // Llama al modelo para traer los datos // El controlador se encarga de recibir la solicitud del usuario, interactuar con el modelo para obtener los datos necesarios y luego pasar esos datos a la vista para que se muestren al usuario. En este caso, el controlador tiene un método listar() que llama al modelo para obtener todos los vehículos y luego devuelve esa información para ser utilizada en la vista.
        return $this->model->leerTodos(); // Llama al método leerTodos() del modelo de Vehículo para obtener la lista de todos los vehículos disponibles en la base de datos. El resultado se devuelve para que pueda ser utilizado en la vista y mostrar la información al usuario.
    }
}