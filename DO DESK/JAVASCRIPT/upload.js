const url = '../PHP/openAITranscribe.php'
const audioPath = '../uploads/'
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
    }).then((Response)  => Response.json())
    .then((json) => {
        console.log(json)
        document.querySelector('#myTextarea').innerHTML = json[0]
        document.querySelector('#sampleTextarea').innerHTML = json[1]
        document.querySelector('#audioPlayer').setAttribute('src', audioPath+json[1])
        document.querySelector('#audio').load();
    })
    
});