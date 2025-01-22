//zapamiętanie aktywnej zakładki
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.nav-link');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    let activeTab = localStorage.getItem('activeTab') || '#uzytkownicy';

    if (![ '#uzytkownicy', '#wizyty' ].includes(activeTab)) {
        activeTab = '#uzytkownicy';
    }

    tabs.forEach(tab => tab.classList.remove('active'));
    tabPanes.forEach(pane => pane.classList.remove('show', 'active'));

    const activeTabElement = document.querySelector(`[href="${activeTab}"]`);
    const activePane = document.querySelector(activeTab);

    if (activeTabElement) {
        activeTabElement.classList.add('active');
    }
    if (activePane) {
        activePane.classList.add('show', 'active');
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            const selectedTab = tab.getAttribute('href');
            localStorage.setItem('activeTab', selectedTab);
s
            tabs.forEach(t => t.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('show', 'active'));
e
            tab.classList.add('active');
            const selectedPane = document.querySelector(selectedTab);
            if (selectedPane) {
                selectedPane.classList.add('show', 'active');
            }
        });
    });
});

function editUser(userId) {

    $.ajax({
        url: 'functions/getAdminData.php',
        method: 'POST',
        data: { userId: userId },
        success: function(response) {
            var user = JSON.parse(response);

            $('#userId').val(user.id);
            $('#userName').val(user.userName);
            $('#fullName').val(user.fullName);
            $('#email').val(user.email);
            $('#passwd').val('');
            $('#status').val(user.status);

            $('#editUserModal').modal('show');
        }
    });
}

function editBooking(bookingId) {
    $.ajax({
        url: 'functions/getAdminData.php',
        method: 'POST',
        data: { bookingId: bookingId },
        success: function(response) {
            var booking = JSON.parse(response);

            $('#bookingId').val(booking.id);
            $('#clientId').val(booking.clientId);
            $('#barberId').val(booking.barberId);
            $('#startDate').val(booking.startDate.replace(' ', 'T'));
            $('#endDate').val(booking.endDate.replace(' ', 'T'));
            $('#service').val(booking.service);
            $('#price').val(booking.price);
            $('#status').val(booking.status);

            $('#editBookingModal').modal('show');
        }
    });
}

document.getElementById('barber').addEventListener('change', function() {
    var barberImage = document.getElementById('barber-image');
    var barberName = this.value;
    
    //ustawienie zdjęcia wybranego barbera
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

function confirmCancellation() {
    return confirm("Czy na pewno chcesz anulować tę wizytę?");
}