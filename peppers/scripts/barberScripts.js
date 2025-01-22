//zapamiętanie aktywnej zakładki
document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.nav-link');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    let activeTab = localStorage.getItem('activeTab') || '#doAkceptacji';

    if (![ '#doAkceptacji', '#nadchodzace', '#zakonczone' ].includes(activeTab)) {
        activeTab = '#doAkceptacji';
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

function confirmCancellation() {
    return confirm("Czy na pewno chcesz anulować tę wizytę?");
}