const url = "../PHP/settings.php"
const changePassword = document.querySelector("#changePassword");
const changeUsername = document.querySelector("#changeUsername");
changePassword.addEventListener('submit', (e) => {
    e.preventDefault();
    const formdata = new FormData();
    formdata.append("oldPassword", document.querySelector("#oldPass").value);
    formdata.append("newPassword", document.querySelector("#newPass").value);
    formdata.append("requestType", "changePassword");
    fetch(url, {
        method: 'POST',
        body: formdata
    }).then((Response) => {
        return Response.text();
    }).then((body) => {
        showSnackbar(body);
        document.querySelector("#oldPass").value = "";
        document.querySelector("#newPass").value = "";
    })
})
function showSnackbar(message) {
    const snackbar = document.getElementById("snackbar");  
    snackbar.textContent = message;
    snackbar.classList.add("show");
    setTimeout(() => {
      snackbar.classList.remove("show");
    }, 3000);
}