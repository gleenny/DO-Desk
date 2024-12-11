const url = '../PHP/openAITranscribe.php'
const texturl = '../PHP/savingText.php'
const violationurl = "../PHP/violations.php"
const audioPath = '../audio/'
const form = document.querySelector('#myform');  
const record = document.querySelector("#record");
const tigil = document.querySelector("#stop");
const saveTranscript = document.querySelector('#saveText');

let filename;

getViolationID();



//save text file and db query
saveTranscript.addEventListener("click", textUpload);
function textUpload(){
  if(document.querySelector("#myTextarea").value && document.querySelector("#violationID").value && filename){
      const formData = new FormData();

      formData.append("textContent", document.querySelector("#myTextarea").value);
      fileParts = filename.split(".");
      formData.append("fileName", fileParts[0]);
      formData.append("fileExtension", fileParts[1]);
      formData.append("violationID", document.querySelector("#violationID").value);
      
      formData.append("requestType", "uploadText");
    
      fetch(texturl, {
        method: 'POST',
        body: formData
      }).then((Response) => {
        showSnackbar("Transcriptions has been saved to " + document.querySelector("#violationID").value)
      })
    }
  else{
    showSnackbar("data is incomplete")
  }
}
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

          const link = document.createElement('a');

          if(clipName != null){
            link.href = blobUrl;
            link.download = clipName
            document.body.appendChild(link)
  
            console.log(link);
          }
          
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

    if(document.querySelector('#myFile').files.length != 0 && document.querySelector("#violationID").selectedIndex != 0){
      const files = document.querySelector('#myFile').files;
      const formData = new FormData();
  
      for (let i = 0; i < files.length; i++){
          let file = files[i]
  
          formData.append('files[]', file)
          formData.append('violationID', document.querySelector("#violationID").value)
      }
  
      showSnackbar("file is uploading");
  
      fetch(url, {
          method: 'POST',
          body: formData,
      }).then((Response)  => Response.json())
      .then((json) => {
          if(json[2] == "error"){
            showSnackbar("there has been an error")
          }
          else{
            showSnackbar("file has been transcribed")
            document.querySelector('#myTextarea').innerHTML = json[0]
            filename = json[1];
            document.querySelector('#audioPlayer').setAttribute('src', audioPath+filename)
            document.querySelector('#audio').load();
          }
      })
    }
    else{
      showSnackbar("file is missing");
    }

});

function getViolationID(){
  const formData = new FormData();

  formData.append("requestType", "getViolationID")
  
  fetch(violationurl, {
      method: 'POST',
      body:formData
  }).then((Response) => Response.json())
  .then((json) => {   
      for(let i = 0; i < json["violationID"].length ; i++){
          let opt = document.createElement('option');
          opt.text = json["violationID"][i]
          opt.value = json["violationID"][i]

          document.querySelector('#violationID').options.add(opt);
      }
  })
}
// Function to show the snackbar with a custom message
function showSnackbar(message) {
  const snackbar = document.getElementById("snackbar");
  
  // Set the custom message
  snackbar.textContent = message;

  // Add the "show" class to make it visible
  snackbar.classList.add("show");

  // Remove the "show" class after 3 seconds
  setTimeout(() => {
    snackbar.classList.remove("show");
  }, 3000);
}