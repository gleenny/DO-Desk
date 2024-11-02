const url = "../PHP/settings.php"
const changePassword = document.querySelector("#changePassword");
const changeUsername = document.querySelector("#changeUsername");

//change password
changePassword.addEventListener('submit', (e) => {
    e.preventDefault();

    const formdata = new FormData();

    formdata.append("oldPassword", document.querySelector("#oldPass").value);
    formdata.append("newPassword", document.querySelector("#newPass").value);

    formdata.append("requestType", "changePassword");

    console.log(formdata)

    fetch(url, {
        method: 'POST',
        body: formdata
    }).then((Response) => {
        return Response.text();
    }).then((body) => {
        console.log(body)
    })
})

//change username
changeUsername.addEventListener('submit', (e) => {
    e.preventDefault();

    const formdata = new FormData();

    formdata.append("oldUsername", document.querySelector("#oldUsername").value);
    formdata.append("newUsername", document.querySelector("#newUsername").value);

    formdata.append("requestType", "changeUsername");

    console.log(formdata)

    fetch(url, {
        method: 'POST',
        body: formdata
    }).then((Response) => {
        return Response.text();
    }).then((body) => {
        console.log(body)
    })
})

