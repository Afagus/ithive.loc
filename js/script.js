let inputFromUser;
let createForm;
let deleteButton;
let objFromFormDB;
alert("Я загрузилась :)");

/*Ожидает загрузки всего DOM, запускает перечень функций
 */
document.addEventListener("DOMContentLoaded", function () {
    addFormAjax();
    makeForExisting("deleteFormButton", deleteFormFunc)
    makeForExisting("deleteField", deleteFormFunc)
    createField();
    makeForExisting("changeField", addFormToRedact);
    formSenderValidator();
});

/*
*Создание новой формы (по нажатию на книпку "create"
* и отображение поля с именем в списке форм на главной странице
*/
function addFormAjax() {
    createForm = document.getElementById("createForm");
    if (createForm) {
        createForm.addEventListener("submit", function () {
            event.preventDefault();
            inputFromUser = createForm[0].value;
            sendAjaxForm(this, function (data) {
                console.log(data);
                addForm(data);
                setEmptyField("fieldOfFormName");
            });
        })
    }
}


/*Бежим по формам (по их классам) и применяем всем им событие
 */
function makeForExisting(className, whatWeDo) {
    var buttonsAll = document.getElementsByClassName(className);
    for (var i = 0; i < buttonsAll.length; i++) {
        buttonsAll[i].onsubmit = whatWeDo;
    }
}

/*
Отрисовка ссылки на форму и кнопки удаления на
странице с выбором форм
 */
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

/*
Очищаем поле, применяем после отправки
 */
function setEmptyField(elementID) {
    var field = document.getElementById(elementID);
    field.value = '';
}

/*
Удаляяем строку с именем поля и кнопкой удаления
 */
function deleteFormFunc(event) {
    event.preventDefault();
    var row = event.path[2];
    sendAjaxForm(this, function () {
        row.remove();
    }, true);
}

/*
Главная функция AJAX, создание объекта для
связи и обмена с сервером, а также создание объекта формы
 */
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

/*
При нажатии на ADD FIELD в Конструкторе формы  появляется новая строка
с именем поля, и все характеристики поля, отправляются с помощью AJAX
 */
function createField() {
    var addField = document.getElementById("addField");
    if (addField) {
        addField.addEventListener("submit", function () {
            var self = this;
            event.preventDefault();
            sendAjaxForm(this, function (response) {
                objFromFormDB = response;
                addFieldFunc();
                self.reset();
            }, true)
        })

    }
}


/*
Отрисовка поля формы для списка, создание атрибутов,
и присвоение им значений
 */
function addFieldFunc() {

    var tbody = document.getElementById("tableOfFieldCreator").getElementsByTagName("TBODY")[0];
    var row = document.createElement("TR");
    var td1 = document.createElement("TD");
    td1.innerText = "Поле ";
    var boldNameOfForm = document.createElement("b");
    boldNameOfForm.id = objFromFormDB[0].id + "_change";
    boldNameOfForm.innerText = objFromFormDB[0].name;
    td1.appendChild(boldNameOfForm);

    var td2 = document.createElement("TD");
    var td2Form = document.createElement("form");

    td2Form.action = "/ithive.loc/deleteField/" + objFromFormDB[0].id;
    td2Form.method = "post";
    td2Form.onsubmit = deleteFormFunc;

    var inputDelete = document.createElement("input");
    inputDelete.type = "submit";
    inputDelete.value = "Delete";
    inputDelete.name = "delete";


    var td3 = document.createElement("TD");
    var td3Form = document.createElement("form");
    td3Form.action = "/ithive.loc/changeField/" + objFromFormDB[0].id;
    td3Form.method = "post";
    td3Form.className = "changeField";
    td3Form.onsubmit = addFormToRedact;


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

/*
 Изменение полей формы, при нажатии на "update field"
 отправляем данные полей аяксом, меняем название
 поля в списке полей и убираем форму
*/
function updateField() {
    var updateField = document.getElementById("updateField");
    if (updateField) {
        updateField.addEventListener("submit", function (event) {
            event.preventDefault();
            sendAjaxForm(this, function (response) {
                updateNameOfField(response);
                updateField.remove();
            }, true);
        })
    } else {

    }

    /*
        Функция для изменения имени поля в списке полей
    */
    function updateNameOfField(response) {
        if (response) {
            var getEl = document.getElementById(response[0].id + "_change");
            getEl.innerText = response[0].name;
        }
    }
}

/*
Выводим форму для редактирования полей, добавляем стилизацию.
Форму берем получая весь HTML из файла
*/
function addFormToRedact() {
    event.preventDefault();
    var el = document.createElement("div");
    var parent = document.getElementById("overTable");
    parent.appendChild(el);
    el.style.backgroundColor = "#81e4d5";
    el.style.display = "inline-block";
    sendAjaxForm(this, function (response) {
        el.innerHTML = response;
        updateField();
    });


}

function formSenderValidator() {

    var formForSend = document.getElementById("formForSend");
    if (formForSend) {

        formForSend.addEventListener("submit", function () {
            event.preventDefault();
            sendAjaxForm(this, function (response, value2) {
                console.log(response);
response.forEach(function (elem,index) {
    var tempVal = document.getElementById(index);
    var createTd = document.createElement("td");
    tempVal.appendChild(createTd).innerText= elem;
})
            }, false);

        })
    }
}