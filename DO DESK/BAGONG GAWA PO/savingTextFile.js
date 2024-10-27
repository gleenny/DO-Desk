let div = document.querySelector("#div1");

let link = document.createElement('a')
link.href = '../txt/test.txt'
link.id = 'link1';

document.querySelector('#div1').appendChild(link);
document.querySelector('#link1').innerHTML = "file 1";