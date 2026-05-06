<?php
namespace App\Config;

use PDO; // 2. Indica que usaremos la clase interna de PHP para bases de datos
use PDOException; // 3. Indica que usaremos la clase de errores de PHP

class Database {  // 4. Clase para manejar la conexión a la base de datos. Esta clase se encarga de establecer la conexión con la base de datos utilizando PDO, y proporciona un método getConnection() que devuelve la conexión establecida. Esto permite que otras partes de la aplicación, como los modelos y controladores, puedan acceder a la base de datos de manera segura y eficiente.
    private $host = "localhost"; 
    private $db_name = "gestion_alquiler";  // El nombre de tu base de datos en gestion_alquiler.sql    
    private $username = "root"; 
    private $password = ""; 
    public $conn; 

    public function getConnection() { // Método para establecer la conexión a la base de datos. Este método intenta crear una nueva conexión utilizando PDO, y si ocurre algún error durante el proceso, captura la excepción y muestra un mensaje de error. Si la conexión es exitosa, devuelve el objeto de conexión para que pueda ser utilizado por otras partes de la aplicación.
        $this->conn = null; // Inicializamos la conexión como null antes de intentar establecerla

        try { // Intentamos establecer la conexión a la base de datos utilizando PDO. Si la conexión es exitosa, se asigna al atributo $conn. Si ocurre un error, se captura la excepción y se muestra un mensaje de error.

            $this->conn = new PDO( // Creamos una nueva instancia de PDO para establecer la conexión a la base de datos. El constructor de PDO recibe los parámetros necesarios para conectarse a la base de datos, como el host, el nombre de la base de datos, el nombre de usuario y la contraseña. En este caso, se utiliza la sintaxis "mysql:host=...;dbname=..." para especificar el tipo de base de datos (MySQL) y los detalles de conexión.
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name, // Construimos la cadena de conexión utilizando los atributos de la clase para especificar el host y el nombre de la base de datos. Esto permite que el código sea más flexible y fácil de mantener, ya que los detalles de conexión se pueden modificar fácilmente en un solo lugar (en los atributos de la clase) sin tener que cambiar el código en varios lugares.
                $this->username, // Pasamos el nombre de usuario para la conexión a la base de datos, que se obtiene del atributo $username de la clase. Esto permite que el código sea más flexible y fácil de mantener, ya que el nombre de usuario se puede modificar fácilmente en un solo lugar (en el atributo de la clase) sin tener que cambiar el código en varios lugares.
                $this->password // Pasamos la contraseña para la conexión a la base de datos, que se obtiene del atributo $password de la clase. Esto permite que el código sea más flexible y fácil de mantener, ya que la contraseña se puede modificar fácilmente en un solo lugar (en el atributo de la clase) sin tener que cambiar el código en varios lugares.
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configuramos el modo de error de PDO para que lance excepciones en caso de errores. Esto permite que el código sea más robusto y fácil de depurar, ya que los errores se pueden manejar de manera más efectiva utilizando bloques try-catch.
            $this->conn->exec("set names utf8"); // Configuramos la codificación de caracteres para la conexión a la base de datos. Esto es importante para asegurarnos de que los datos se manejen correctamente, especialmente si se utilizan caracteres especiales o acentos en los datos almacenados en la base de datos.
        } catch(PDOException $exception) { // Capturamos cualquier excepción que ocurra durante el proceso de conexión a la base de datos. Si ocurre un error, se muestra un mensaje de error que incluye la información de la excepción. Esto permite que el código sea más robusto y fácil de depurar, ya que los errores se pueden manejar de manera más efectiva utilizando bloques try-catch.
            echo "Error de conexión: " . $exception->getMessage(); // Mostramos un mensaje de error que incluye la información de la excepción. Esto permite que el código sea más robusto y fácil de depurar, ya que los errores se pueden manejar de manera más efectiva utilizando bloques try-catch.
        }

        return $this->conn; 
    }
}