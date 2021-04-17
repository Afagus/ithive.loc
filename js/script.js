let lastId;
let inputFromUser;
let createForm;
let deleteButton;
document.addEventListener("DOMContentLoaded", function () {

    createForm = document.getElementById("createForm");
    createForm.addEventListener("submit", function () {

        event.preventDefault();
        inputFromUser = createForm[0].value;


        const xhr = new XMLHttpRequest();
        const url = this.action;
        const params = "name=" + inputFromUser;
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.addEventListener("readystatechange", () => {

            if (xhr.readyState === 4 && xhr.status === 200) {
                lastId = xhr.responseText;
                console.log(xhr.responseText);

                addForm("myTable");
                setEmptyField();
                

            }
        });
        xhr.send(params);
    })


});

function addForm(id) {
    var tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
    var row = document.createElement("TR")
    var td1 = document.createElement("TD")
    var a = document.createElement('a')
    a.setAttribute('href',"showForm/"+ lastId);
    a.innerHTML = "Ссылка на форму "+ inputFromUser;
    td1.appendChild(a)

    var td2 = document.createElement("TD")
    deleteButton = document.createElement("button")
    deleteButton.innerText = "delete Form";
    deleteButton.setAttribute('href',"deleteForm/"+ lastId)
    document.addEventListener('click', function (e) {
        
    })
    td2.appendChild(deleteButton);
    row.appendChild(td1);
    row.appendChild(td2);
    tbody.appendChild(row);
}


function setEmptyField() {
    var field= document.getElementById("fieldOfFormName");
    field.value = '';
}
