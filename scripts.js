document.getElementById('search-button').addEventListener('click', search); // Añade un evento de clic al botón de búsqueda que llama a la función search

function search() { // Función para realizar la búsqueda de paquetes
    const destination = document.getElementById('destination').value; // Obtiene el valor del destino ingresado
    const travelDate = document.getElementById('travel-date').value; // Obtiene la fecha de viaje seleccionada
    const resultsContainer = document.getElementById('results-container'); // Selecciona el contenedor para mostrar los resultados
    resultsContainer.innerHTML = ''; // Limpia el contenedor de resultados

    const results = filterPackages(destination, travelDate); // Filtra los paquetes según el destino y la fecha
    results.forEach(package => { // Itera sobre cada paquete filtrado
        const resultElement = document.createElement('div'); // Crea un nuevo elemento div para cada resultado
        resultElement.className = 'result'; // Asigna una clase CSS para el estilo del resultado
        resultElement.innerHTML = `
            <h3>${package.destination}</h3>
            <p>Fecha: ${package.date}</p>
            <p>Precio: $${package.price}</p>
            <p>Disponibilidad: ${package.availability}</p>
        `; // Establece el contenido HTML del resultado

        resultsContainer.appendChild(resultElement); // Añade el elemento de resultado al contenedor de resultados
    });
}

function filterPackages(destination, date) { // Función para filtrar los paquetes según el destino y la fecha
    return packages.filter(package => { // Filtra el array de paquetes
        return package.destination.toLowerCase().includes(destination.toLowerCase()) && // Comprueba si el destino incluye el valor buscado
               package.date === date; // Comprueba si la fecha coincide
    });
}

class Package { // Clase para representar un paquete de viaje
    constructor(destination, date, price, availability) { // Constructor que inicializa las propiedades del paquete
        this.destination = destination; // Asigna el destino del paquete
        this.date = date; // Asigna la fecha del paquete
        this.price = price; // Asigna el precio del paquete
        this.availability = availability; // Asigna la disponibilidad del paquete
    }

    updateAvailability(newAvailability) { // Método para actualizar la disponibilidad del paquete
        this.availability = newAvailability; // Asigna la nueva disponibilidad
    }

    displayInfo() { // Método para mostrar la información del paquete
        return `${this.destination} - ${this.date}: $${this.price} (${this.availability})`; // Retorna una cadena con la información del paquete
    }
}

// Array de paquetes de viaje
const packages = [
    new Package('Balmaceda', '2024-08-01', 23000, 'Disponible'),
    new Package('Puerto Natales', '2024-08-02', 50000, 'Disponible'),
    new Package('Punta Arenas', '2024-08-03', 40000, 'Agotado'),
    new Package('Balmaceda', '2024-08-04', 23000, 'Disponible'),
    new Package('Puerto Natales', '2024-08-05', 50000, 'Disponible'),
    new Package('Punta Arenas', '2024-08-06', 40000, 'Agotado'),
    new Package('Balmaceda', '2024-08-07', 23000, 'Disponible'),
    new Package('Puerto Natales', '2024-08-08', 50000, 'Disponible'),
    new Package('Punta Arenas', '2024-08-09', 40000, 'Agotado'),
];

function showNotification(message) { // Función para mostrar una notificación en la pantalla
    const notification = document.createElement('div'); // Crea un nuevo elemento div para la notificación
    notification.className = 'notification'; // Asigna una clase CSS para el estilo de la notificación
    notification.innerText = message; // Establece el texto de la notificación
    document.body.appendChild(notification); // Añade la notificación al cuerpo del documento
    setTimeout(() => { // Configura un temporizador para eliminar la notificación después de 2 segundos
        notification.remove(); // Elimina la notificación
    }, 2000);
}

function updateRealTime() { // Función para actualizar la disponibilidad de los paquetes en tiempo real
    setInterval(() => { // Configura un intervalo que se ejecuta cada 20 segundos
        const randomPackage = packages[Math.floor(Math.random() * packages.length)]; // Selecciona un paquete aleatorio
        randomPackage.updateAvailability('Disponible'); // Actualiza la disponibilidad del paquete seleccionado
        showNotification(`Oferta especial: ${randomPackage.displayInfo()}`); // Muestra una notificación con la información del paquete
    }, 20000);
}

function keepSessionAlive() { // Función para mantener la sesión activa
    fetch('keep_session_alive.php') // Realiza una solicitud al archivo PHP para mantener la sesión
        .then(response => response.text()) // Convierte la respuesta a texto
        .then(data => console.log(data)) // Muestra los datos en la consola
        .catch(error => console.error('Error:', error)); // Muestra errores en la consola
}

// Ejecutar la función para mantener la sesión activa cada 5 minutos
setInterval(keepSessionAlive, 300000); // 300000 ms = 5 minutos

document.addEventListener('DOMContentLoaded', updateRealTime); // Añade un evento que llama a updateRealTime cuando el DOM está completamente cargado
