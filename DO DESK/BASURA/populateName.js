document.addEventListener("DOMContentLoaded", function() {
    fetch('../PHP/getUserData.php')
        .then(response => response.json())
        .then(userData => {
            if (userData.middleName != null) {
                if (userData.suffixName  != null) {
                    document.getElementById('accountName').textContent = `${userData.firstName} ${userData.middleName} ${userData.lastName} ${userData.suffixName}`;
                } else {
                    document.getElementById('accountName').textContent = `${userData.firstName} ${userData.middleName} ${userData.lastName}`;
                }
            } else {
                if (userData.suffixName != null) {
                    document.getElementById('accountName').textContent = `${userData.firstName} ${userData.lastName} ${userData.suffixName}`;
                } else {
                    document.getElementById('accountName').textContent = `${userData.firstName} ${userData.lastName}`;
                }
            }
            
            document.getElementById('accountRole').textContent = userData.role;
        })
        .catch(error => console.error('Error fetching user data:', error));
});