let div = document.querySelector("#div1");

let filename = 'hello.txt';

fileParts = filename.split(".");
//formData.append("fileName", fileParts[0]);
//formData.append("fileExtension", fileParts[1]);

let link = document.createElement('a')
link.href = '../txt/test.txt'
link.id = 'link1';

document.querySelector('#div1').appendChild(link);
document.querySelector('#link1').innerHTML = fileParts[1];

