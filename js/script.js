let lastId;
let inputFromUser;
let createForm;
let deleteButton;

document.addEventListener("DOMContentLoaded", function () {
    addFormAjax();
    var buttonsAll = document.getElementsByClassName("deleteFormButton");
    for (var i = 0; i < buttonsAll.length; i++) {
        buttonsAll[i].onsubmit = deleteFormFunc;
    }
    createField();

});


function addFormAjax() {
    createForm = document.getElementById("createForm");
    if (createForm) {
        createForm.addEventListener("submit", function () {

            event.preventDefault();
            inputFromUser = createForm[0].value;
            sendAjaxForm(this, function (data) {
                addForm(data);
                setEmptyField();
            });
        })
    }
}

function addForm(lastId) {
    var tbody = document.getElementById("myTable").getElementsByTagName("TBODY")[0];
    var row = document.createElement("TR");
    var td1 = document.createElement("TD");
    var a = document.createElement('a');
    a.setAttribute('href', "showForm/" + lastId);
    a.innerHTML = "Ссылка на форму " + inputFromUser;
    td1.appendChild(a);

    var td2 = document.createElement("TD");
    deleteButton = document.createElement("form");
    deleteButton.onsubmit = deleteFormFunc;
    deleteButton.id = "deleteButton";
    deleteButton.method = "post";
    deleteButton.action = "deleteForm/" + lastId;
    var inputSubmit = document.createElement("input");
    inputSubmit.type = "submit";
    inputSubmit.value = "delete Form";
    inputSubmit.name = "deleteFormButton";
    var inputHidden = document.createElement("input");
    inputHidden.type = "hidden";
    inputHidden.value = lastId;
    deleteButton.append(inputSubmit);
    deleteButton.append(inputHidden);


    td2.appendChild(deleteButton);
    row.appendChild(td1);
    row.appendChild(td2);
    tbody.appendChild(row);

}

function setEmptyField() {
    var field = document.getElementById("fieldOfFormName");
    field.value = '';
}

function deleteFormFunc(event) {
    event.preventDefault();
    var row = event.path[2];

    sendAjaxForm(this, function () {
        row.remove();
    });
}


function sendAjaxForm(form, callback) {
    var XHR = new XMLHttpRequest();
    var data = new FormData(form);
    XHR.open("POST", form.action, true);
    XHR.onreadystatechange = function (response) {
        if (this.readyState === 4 && this.status === 200) {
            callback(this.response, this)
        }
    };
    XHR.send(data);
}

function createField() {
    var addField = document.getElementById("addField");
    if (addField) {
        addField.addEventListener("submit", function () {
            event.preventDefault();
            sendAjaxForm(this, function () {
                this.responseText;
            })

            addFieldFunc();



        })
    }
}

function addFieldFunc(lastId) {


    var tbody = document.getElementById("tableOfFieldCreator").getElementsByTagName("TBODY")[0];
    var row = document.createElement("TR");
    var td1 = document.createElement("TD");
    td1.innerText = "Поле";
    var td2 = document.createElement("TD");
    var td2Form = document.createElement("form");
    td2Form.action = "deleteField/" + lastId;
    td2.appendChild(td2Form);


    row.append(td1);
    row.append(td2);
    tbody.appendChild(row);


}