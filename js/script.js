document.addEventListener("DOMContentLoaded", function () {

    let createForm = document.getElementById("createForm");
    createForm.addEventListener("submit", function () {

        event.preventDefault();
        let inputFromUser = createForm[0].value;


        const xhr = new XMLHttpRequest();
        const url = this.action;
        const params = "name="+inputFromUser;
        xhr.open("POST", url,true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.addEventListener("readystatechange", () => {

            if(xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
            }
        });

        xhr.send(params);


    })


});