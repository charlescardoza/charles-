<!-- creación de una clase que represente un filtro interactivo para destinos y fechas de viaje, 
 con sus propiedades (nombre del hotel, ciudad, país, fecha de viaje, duración del viaje) y métodos 
 que faciliten su gestión y permitan a los usuarios realizar búsquedas personalizadas.  -->

<?php
class TravelFilter { // Clase para filtrar búsquedas de viajes
    public $hotelName; // Nombre del hotel
    public $city; // Ciudad de destino
    public $country; // País de destino
    public $travelDate; // Fecha de viaje
    public $tripDuration; // Duración del viaje en días

    // Constructor de la clase que inicializa las propiedades
    public function __construct($hotelName, $city, $country, $travelDate, $tripDuration) {
        $this->hotelName = $hotelName; // Asigna el nombre del hotel
        $this->city = $city; // Asigna la ciudad
        $this->country = $country; // Asigna el país
        $this->travelDate = $travelDate; // Asigna la fecha de viaje
        $this->tripDuration = $tripDuration; // Asigna la duración del viaje
    }

    // Método para realizar la búsqueda basada en los filtros
    public function search() {
        // Lógica para realizar la búsqueda basada en los filtros
        // Este es solo un ejemplo y se debe ajustar según los requisitos
        return "Buscando en {$this->city}, {$this->country} desde {$this->travelDate} por {$this->tripDuration} días."; // Retorna un mensaje con los detalles de la búsqueda
    }
}
?>
