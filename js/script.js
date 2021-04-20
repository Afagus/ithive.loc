let lastId;
let inputFromUser;
let createForm;
let deleteButton;
let objFromFormDB;
document.addEventListener("DOMContentLoaded", function () {
    addFormAjax();
    deleterForExisting("deleteFormButton")
    deleterForExisting()
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
function deleterForExisting(className) {
    var buttonsAll = document.getElementsByClassName(className);
    for (var i = 0; i < buttonsAll.length; i++) {
        buttonsAll[i].onsubmit = deleteFormFunc;
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
    }, true);
}


function sendAjaxForm(form, callback, json) {
    var XHR = new XMLHttpRequest();
    var data = new FormData(form);
    XHR.responseType = json ? 'json' : 'text';
    XHR.open("POST", form.action, true);
    XHR.onreadystatechange = function (response) {
        if (this.readyState === 4 && this.status === 200) {
            callback && callback(this.response, this)
        }
    };
    XHR.send(data);
}

function OBRABITCHIK_ZAPROSA(response) {
    //console.log(response);
    objFromFormDB = response;
    addFieldFunc();
}


function createField() {
    var addField = document.getElementById("addField");
    if (addField) {
        addField.addEventListener("submit", function () {
            event.preventDefault();
            sendAjaxForm(this,OBRABITCHIK_ZAPROSA , true)



        })
    }
}

function addFieldFunc() {

console.log(objFromFormDB);
    var tbody = document.getElementById("tableOfFieldCreator").getElementsByTagName("TBODY")[0];
    var row = document.createElement("TR");
    var td1 = document.createElement("TD");
    td1.innerText = "Поле";

    var td2 = document.createElement("TD");
    var td2Form = document.createElement("form");
    td2Form.action = "/ithive.loc/deleteField/"+ objFromFormDB[0].id;
    td2Form.method = "post";
    td2Form.onsubmit = deleteFormFunc;
    var inputDelete = document.createElement("input");
    inputDelete.type = "submit";
    inputDelete.value = "Delete";
    inputDelete.name = "delete";


    var td3 = document.createElement("TD");
    var td3Form = document.createElement("form");
    td3Form.action = "/ithive.loc/changeField/" + lastId;
    td3Form.method = "post";
    var inputChange = document.createElement("input");
    inputChange.type = "submit";
    inputChange.value = "Change";
    inputChange.name = "change";

    td2Form.append(inputDelete);
    td3Form.append(inputChange);

    td2.appendChild(td2Form);
    td3.appendChild(td3Form);


    row.append(td1);
    row.append(td2);
    row.append(td3);
    tbody.appendChild(row);


}