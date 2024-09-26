const url = '../PHP/openAITranscribe.php'
const audioPath = '../uploads/'
const form = document.querySelector('#myform');  

const record = document.querySelector("#record")
const tigil = document.querySelector("#stop")

//recording
if (navigator.mediaDevices) {
    console.log("getUserMedia supported.");
  
    const constraints = { audio: true };
    let chunks = [];
  
    navigator.mediaDevices
      .getUserMedia(constraints)
      .then((stream) => {
        const mediaRecorder = new MediaRecorder(stream, {mimeType: 'audio/webm'});
  
        record.onclick = () => {
          mediaRecorder.start();
          console.log(mediaRecorder.state);
          console.log("recorder started");
          record.style.background = "red";
          record.style.color = "black";
        };
  
        tigil.onclick = () => {
          mediaRecorder.stop();
          console.log(mediaRecorder.state);
          console.log("recorder stopped");
          record.style.background = "";
          record.style.color = "";
        };
  
        mediaRecorder.onstop = (e) => {
          const clipName = prompt("Enter a name for your sound clip");
  
          audio.controls = true;
          const blob = new Blob(chunks, { type: "audio/webm; codecs=opus" });
          chunks = [];
          const audioURL = URL.createObjectURL(blob);
          audio.src = audioURL;
          console.log("recorder stopped");
  
          const blobUrl = URL.createObjectURL(blob);

          //download audio file
          const link = document.createElement('a');
          link.href = blobUrl;
          link.download = clipName
          document.body.appendChild(link)

          console.log(link);

          link.dispatchEvent(
            new MouseEvent('click', {
              bubbles: true,
              cancelable: true,
              view: window,
            })
          );
        };
  
        mediaRecorder.ondataavailable = (e) => {
          chunks.push(e.data);
        };
      })
      .catch((err) => {
        console.error(`The following error occurred: ${err}`);
      });
  }
//transcribe
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
        document.querySelector('#audioPlayer').setAttribute('src', audioPath+json[1])
        document.querySelector('#audio').load();
    })
    
});