document.addEventListener("DOMContentLoaded", function() {
    fetch('../PHP/getUserData.php')
        .then(response => response.json())
        .then(userData => {
            document.getElementById('accountName').textContent = `${userData.firstName} ${userData.middleName} ${userData.lastName}`;
            document.getElementById('accountRole').textContent = userData.role;
        })
        .catch(error => console.error('Error fetching user data:', error));
});