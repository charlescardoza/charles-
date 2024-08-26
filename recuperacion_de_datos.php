<?php
session_start([
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'use_strict_mode' => true,
    'gc_maxlifetime' => 1800, //  30 minutos
]);

// Verifica si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario con sanitización
    $hotelName = htmlspecialchars($_POST['hotelName'], ENT_QUOTES, 'UTF-8');
    $city = htmlspecialchars($_POST['city'], ENT_QUOTES, 'UTF-8');
    $country = htmlspecialchars($_POST['country'], ENT_QUOTES, 'UTF-8');
    $travelDate = htmlspecialchars($_POST['travelDate'], ENT_QUOTES, 'UTF-8');
    $tripDuration = htmlspecialchars($_POST['tripDuration'], ENT_QUOTES, 'UTF-8');

    // Crea una instancia de la clase TravelFilter con los datos del formulario
    $travelFilter = new TravelFilter($hotelName, $city, $country, $travelDate, $tripDuration);

    // Llama al método search de la instancia creada y guarda el resultado
    $searchResult = $travelFilter->search();

    // Muestra el resultado de la búsqueda
    echo "<p>$searchResult</p>";
}

class TravelFilter {
    public $hotelName;
    public $city;
    public $country;
    public $travelDate;
    public $tripDuration;

    public function __construct($hotelName, $city, $country, $travelDate, $tripDuration) {
        $this->hotelName = $hotelName;
        $this->city = $city;
        $this->country = $country;
        $this->travelDate = $travelDate;
        $this->tripDuration = $tripDuration;
    }

    public function search() {
        return "Buscando en {$this->city}, {$this->country} desde {$this->travelDate} por {$this->tripDuration} días.";
    }
}
?>
