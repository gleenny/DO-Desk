const url = '../PHP/getStudentData.php'

let studentCount = 1;
let studentNameHolder;
let parentNameHolder;

getStudentInfo();

function getStudentInfo(){
    fetch(url, {
        method: 'GET'
    }).then((Response) => Response.json())
    .then((json) => {
        console.log("hello world")
        
        for(let i = 0; i <= studentCount; i++){

            let tableRow = document.createElement('tr');
            tableRow.id = 'studentList' + i;
        
            let studentNumber = document.createElement('td');
            studentNumber.id = 'studentNumber' + i;

            if(json["middleName"][i] == null){
                studentNameHolder = json["firstName"][i] + " " + json["lastName"][i];
            }
            else{
                studentNameHolder = json["firstName"][i] + " " + json["middleName"][i] + " " + json["lastName"][i];
            }  

            let studentName = document.createElement('td');
            studentName.id = 'studentName' + i;
            let course = document.createElement('td');
            course.id = 'course' + i;
            let section = document.createElement('td');
            section.id = 'section' + i;


            let active = document.createElement('td');
            active.id = 'active' + i;
            let parentID = document.createElement('td');
            parentID.id = 'parentID' + i;
            let parentName = document.createElement('td');

            if(json["parentMiddle"][i] == null){
                parentNameHolder = json["parentFirst"][i] + " " + json["parentLast"][i];
            }
            else{
                parentNameHolder = json["parentFirst"][i] + " " + json["parentMiddle"][i] + " " + json["parentLast"][i];
            }  
            parentName.id = 'parentName' + i;
            let mobileNumber = document.createElement('td');
            mobileNumber.id = 'mobileNumber' + i;

            document.querySelector('#studentInfos').appendChild(tableRow);
            document.querySelector('#studentList' + i).appendChild(studentNumber);
                document.querySelector('#studentNumber' + i).innerHTML = json["studentNumber"][i];

            document.querySelector('#studentList' + i).appendChild(studentName);
                document.querySelector('#studentName' + i).innerHTML = studentNameHolder;

            document.querySelector('#studentList' + i).appendChild(course);
                document.querySelector('#course' + i).innerHTML = json["course"][i];

            document.querySelector('#studentList' + i).appendChild(section);
                document.querySelector('#section' + i).innerHTML = json["section"][i];

            document.querySelector('#studentList' + i).appendChild(active);
                document.querySelector('#active' + i).innerHTML = json["active"][i];

            document.querySelector('#studentList' + i).appendChild(parentID);
                document.querySelector('#parentID' + i).innerHTML = json["parentID"][i];

            document.querySelector('#studentList' + i).appendChild(parentName);
                document.querySelector('#parentName' + i).innerHTML = parentNameHolder;

            document.querySelector('#studentList' + i).appendChild(mobileNumber);
                document.querySelector('#mobileNumber' + i).innerHTML = json["mobileNumber"][i];
        }

        //document.querySelector('#student').innerHTML = json["studentNumber"][0];
    })
}