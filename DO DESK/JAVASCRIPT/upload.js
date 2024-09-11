const url = '../PHP/openAITranscribe.php'
const form = document.querySelector('#myform');

form.addEventListener('submit', (e) => {
    e.preventDefault()

    const files = document.querySelector('#myFile').files;
    const formData = new FormData();

    for (let i = 0; i < files.length; i++){
        let file = files[i]

        formData.append('files[]', file)
    }

    fetch(url, {
        method: 'POST',
        body: formData,
    }).then((Response)  => Response.text())
    .then((text) => {
        document.querySelector('#transcriptions').innerHTML = text;
    })
});