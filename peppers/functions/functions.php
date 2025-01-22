<?php
//dostęp do pliku
$allowed_files = ['management.php', 'bookings.php', 'editBooking.php'];

$current_file = basename($_SERVER['PHP_SELF']);

if (!in_array($current_file, $allowed_files)) {
    header('Location: ../index.php');
    exit;
}
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    //aktualizacja dostępnych godzin
    function updateAvailableHours() {
    const date = $('#date').val();
    const barberId = $('#barber').val();
    const service = $('#service').val();

    const currentDate = new Date();
    const selectedDate = new Date(date);
    const isToday = currentDate.toISOString().slice(0, 10) === selectedDate.toISOString().slice(0, 10);

    if (date && barberId) {
        $.ajax({
            url: 'functions/getAvailableHours.php',
            type: 'GET',
            data: { date: date, barberId: barberId, service: service },
            success: function(response) {
                const availableHours = JSON.parse(response);
                const timeSelect = $('#time');
                timeSelect.empty();

                // jeżeli brak dostępnych godzin
                if (availableHours.length === 0) {
                    timeSelect.append(new Option('Brak dostępnych godzin', ''));
                    return;
                }

                let hoursAdded = false; // flaga, czy dodano jakiekolwiek godziny

                availableHours.forEach(hour => {
                    let [hourPart, minutePart] = hour.split(':').map(Number);
                    let hourTime = new Date(selectedDate);
                    hourTime.setHours(hourPart, minutePart, 0, 0);

                    if (isToday) {
                        const currentTime = new Date();
                        const timeDifference = (hourTime - currentTime) / 60000; // różnica w minutach

                        // sprawdzanie, czy godzina już minęła lub zostało do niej mniej niż 30 minut
                        if (timeDifference <= 30) {
                            return;
                        }
                    }

                    // dodanie godziny do listy
                    timeSelect.append(new Option(hour, hour));
                    hoursAdded = true;
                });

                // jeżeli po przefiltrowaniu żadna godzina nie została dodana
                if (!hoursAdded) {
                    timeSelect.append(new Option('Brak dostępnych godzin', ''));
                }
            }
        });
    }
}


    $(document).ready(function() {
    //nasłuch na zmianę daty
    $('#date').on('change', function() {
        updateAvailableHours();
    });

    //nasłuch na zmianę barbera
    $('#barber').on('change', function() {
        updateAvailableHours();
    });

    //nasłuch na zmianę usługi
    $('#service').on('change', function() {
        updateAvailableHours();
    });
});

</script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('date');

        //daty świąt
        const holidays = [
            '01-01', //Nowy Rok
            '06-01', //Trzech Króli
            '01-05', //Święto Pracy
            '03-05', //Święto Konstytucji 3 Maja
            '15-08', //Wniebowzięcie Najświętszej Maryi Panny
            '11-11', //Święto Niepodległości
            '24-12', //Wigilia
            '25-12', //Boże Narodzenie
            '26-12'  //Drugi dzień Bożego Narodzenia
        ];

        //blokowanie weekendów i dat z przeszłości
        function disableInvalidDates() {
            const selectedDate = new Date(dateInput.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const dayOfWeek = selectedDate.getDay(); //0 - niedziela, 6 - sobota
            const formattedDate = selectedDate.toISOString().slice(5, 10); //format MM-DD

            //sprawdzenie daty
            if (selectedDate < today) {
                alert('Nie możesz wybrać daty z przeszłości!');
                dateInput.value = '';
            } else if (dayOfWeek === 0 || dayOfWeek === 6 || holidays.includes(formattedDate)) {
                alert('Nie pracujemy w weekendy ani w dni świąteczne!');
                dateInput.value = '';
            }
        }

        dateInput.addEventListener('change', disableInvalidDates);
    });
</script>