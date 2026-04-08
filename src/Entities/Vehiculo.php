<?php
namespace App\Entities; // Namespace para organizar el código
// EL namespace se usa para organizar el código y evitar conflictos de nombres entre clases. En este caso, "App\Entities" indica que esta clase pertenece al módulo de entidades de la aplicación.
class Vehiculo {
    // Atributos privados (Seguimso el principio de "Encapsulamiento")
    private $id;
    private $marca;
    private $modelo;
    private $anio;
    private $categoria;
    private $estado;
    // se utiliza el $ para indicar que es una variable, y el "private" para indicar que solo se puede acceder a estos atributos desde dentro de la clase, lo que ayuda a proteger los datos y mantener la integridad de la información.
    public function __construct($marca, $modelo, $anio, $categoria, $estado = 'Disponible') { //se utiliza el funcion __construct para definir un constructor que se ejecuta automáticamente al crear una nueva instancia de la clase. Este constructor recibe parámetros para inicializar los atributos del vehículo, y el estado por defecto se establece como 'Disponible'.
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->anio = $anio;
        $this->categoria = $categoria;
        $this->estado = $estado;
    } //se vuelve a utilizar el $ para indicar que estamos accediendo a los atributos de la clase, y el "public" para indicar que este método se puede llamar desde fuera de la clase. El constructor se encarga de inicializar los atributos del vehículo cuando se crea una nueva instancia de la clase.

    // Getters con sanitización básica para la Vista
    public function getMarca() {
        return htmlspecialchars($this->marca);
    }

    public function getModelo() {
        return htmlspecialchars($this->modelo);
    }

    public function getEstado() {
        return $this->estado;
    } // geters para obtener los valores de los atributos. En este caso, se utiliza la función htmlspecialchars para sanitizar los datos antes de devolverlos, lo que ayuda a prevenir ataques de inyección de código en la vista.

    // Setters para actualizar datos
    public function setEstado($nuevoEstado) {
        $this->estado = $nuevoEstado;
    }

    //se pueden agregar mas geters y seters depende de como vaya el desarrollo de la aplicación, pero por ahora con estos es suficiente para manejar el estado del vehículo y mostrar su información básica en la vista.
}