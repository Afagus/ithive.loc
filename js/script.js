let lastId;
let inputFromUser;
let createForm;
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

                addRow("myTable");
                setEmptyField();

            }
        });
        xhr.send(params);
    })


});

function addRow(id) {
    var tbody = document.getElementById(id).getElementsByTagName("TBODY")[0];
    var row = document.createElement("TR")
    var td1 = document.createElement("TD")
    td1.appendChild(document.createTextNode(addStringOfHref()))
    var td2 = document.createElement("TD")
    td2.appendChild(document.createTextNode(addDeleteBtn()))
    row.appendChild(td1);
    row.appendChild(td2);
    tbody.appendChild(row);
}

function setEmptyField() {
    var field= document.getElementById("fieldOfFormName");
    field.value = '';
    console.log(field);
}

function addStringOfHref() {
    return 'I`m href';
}

function addDeleteBtn() {
    return 'I`m deleter'
}