function confirmCancellation() {
    return confirm("Czy na pewno chcesz anulować tę wizytę?");
}

//ustawienie zdjęcia wybranego barbera
document.getElementById('barber').addEventListener('change', function() {
    var barberImage = document.getElementById('barber-image');
    var barberName = this.value;
    
    switch(barberName) {
        case '20': // Tomek
            barberImage.src = 'img/barber_mini1.jpg';
            barberImage.alt = 'Tomek';
            break;
        case '21': // Louis
            barberImage.src = 'img/barber_mini2.jpg';
            barberImage.alt = 'Louis';
            break;
        case '22': // Bartek
            barberImage.src = 'img/barber_mini3.jpg';
            barberImage.alt = 'Bartek';
            break;
        case '23': // Damian
            barberImage.src = 'img/barber_mini4.jpg';
            barberImage.alt = 'Damian';
            break;
        default: //bez ustawionego zdjęcia
            barberImage.src = 'img/barberDefault.jpg';
            barberImage.alt = 'Barber';
    }
});