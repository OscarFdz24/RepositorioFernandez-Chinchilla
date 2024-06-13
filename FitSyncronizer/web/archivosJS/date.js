function mostrarFecha() {
    var fechaActual = new Date();
    var diaSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    var dia = fechaActual.getDate();
    var nombreDia = diaSemana[fechaActual.getDay()]; // Obtener el nombre del día de la semana
    var mes = fechaActual.toLocaleString('es-ES', { month: 'long' }); // Obtener el nombre del mes
    var año = fechaActual.getFullYear();
    var hora = fechaActual.getHours();
    var minutos = fechaActual.getMinutes();
    var segundos = fechaActual.getSeconds();

    // Asegurarse de que los números tengan dos dígitos
    dia = (dia < 10) ? '0' + dia : dia;
    mes = (mes < 10) ? '0' + mes : mes;
    hora = (hora < 10) ? '0' + hora : hora;
    minutos = (minutos < 10) ? '0' + minutos : minutos;
    segundos = (segundos < 10) ? '0' + segundos : segundos;

    var fechaHora = nombreDia + ', ' + dia + ' de ' + mes + ' de ' + año + ' - ' + hora + ':' + minutos + ':' + segundos;

    document.getElementById('fecha').innerText = fechaHora;
}

// Mostrar la fecha inicial
mostrarFecha();

// Actualizar la fecha cada segundo
setInterval(mostrarFecha, 1000);
