const url = "../PHP/setStudents.php";
const studentForm = document.querySelector("#myformStudent");
const parentForm = document.querySelector("#myformParent");
const pairingForm = document.querySelector("#myformPairing");

console.log("JS connected");

//adding student
studentForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData();

    formData.append("studentNumber", document.querySelector("#studentNumber").value);
    formData.append("firstName", document.querySelector("#studentfirstName").value);
    formData.append("middleName", document.querySelector("#studentMiddleName").value);
    formData.append("lastName", document.querySelector("#studentLastName").value);
    formData.append("course", document.querySelector("#course").value);
    formData.append("section", document.querySelector("#section").value);
    formData.append("requestType", "Students");

    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        console.log(body)
        console.log("Student has been added to database")
    })
})

//adding parents
parentForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData();

    formData.append("firstName", document.querySelector("#parentfirstName").value);
    formData.append("middleName", document.querySelector("#parentMiddleName").value);
    formData.append("lastName", document.querySelector("#parentLastName").value);
    formData.append("mobileNumber", document.querySelector("#mobileNumber").value);
    formData.append("requestType", "Parents");

    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        console.log(body)
        console.log("Parent has been added to database")
    })
})

pairingForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData();

    formData.append("studentNumberPair", document.querySelector("#studentNumberPair").value);
    formData.append("parentNumberPair", document.querySelector("#parentNumberPair").value);
    formData.append("requestType", "Pairing");

    fetch(url, {
        method: 'POST',
        body: formData
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        console.log(body)
        console.log("Student has been paired with parent")
    })
})