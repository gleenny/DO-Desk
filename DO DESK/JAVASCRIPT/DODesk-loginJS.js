document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('../PHP/logincheck.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const messageBox = document.getElementById('message-box');

        if (data.status === 'success') {
            messageBox.textContent = 'Login successful! Redirecting to the dashboard...';
            messageBox.className = 'message-box message-success'; 
            messageBox.style.display = 'block';

            setTimeout(() => {
                window.location.href = '../Final HTML/DODesk-Dashboard.html';  
            }, 1500); 
        } else if (data.status === 'invalid_password') {
            messageBox.textContent = 'Password incorrect. Please try again.';
            messageBox.className = 'message-box message-error'; 
            messageBox.style.display = 'block';
        } else if (data.status === 'user_not_found') {
            messageBox.textContent = 'User not found. Please check your email.';
            messageBox.className = 'message-box message-error'; 
            messageBox.style.display = 'block';
        }
    })
    .catch(error => {
        const messageBox = document.getElementById('message-box');
        messageBox.textContent = 'An error occurred. Please try again later.';
        messageBox.className = 'message-box message-error'; 
        messageBox.style.display = 'block';
        console.error('Error:', error);
    });
});


/*document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();  

    const formData = new FormData(this);

    
    fetch('../PHP/logincheck.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  
    .then(data => {
        if (data.status === 'success') {
            window.location.href = '../Final HTML/DODesk-Dashboard.html';  
        } else if (data.status === 'invalid_password') {
            alert('Password incorrect. Please try again.');
        } else if (data.status === 'user_not_found') {
            alert('User not found. Please check your email.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again later.');
    });
}); */
