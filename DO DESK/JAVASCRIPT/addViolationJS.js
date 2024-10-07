const url = "../PHP/setViolationData.php";
const form = document.querySelector('#myform');

form.addEventListener('submit', (e) => {
    e.preventDefault()

    const formData = new FormData();

    formData.append("violationType", document.querySelector("#violationType").value);
    formData.append("violationCase", document.querySelector("#violationCase").value);
    formData.append("studentNumber", document.querySelector("#studentNumber").value);

    fetch(url, {
        method: 'POST',
        body: formData,
    }).then((Response) => {
        return Response.text()
    }).then((body) => {
        console.log(body)
    })

});