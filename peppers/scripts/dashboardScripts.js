document.getElementById('logoutLink').addEventListener('click', function () {
    localStorage.removeItem('rememberedUsername');
    localStorage.removeItem('rememberedPassword');
});

document.getElementById("deleteAccountBtn").addEventListener("click", function(event) {
    event.preventDefault();
    
    if (confirm("Czy na pewno chcesz usunąć swoje konto? Ta operacja jest nieodwracalna.")) {
        window.location.href = "dashboard.php?deleteAccount=true";
    }
});