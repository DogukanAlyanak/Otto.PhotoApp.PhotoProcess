$(document).on(`submit`, `#loginForm`, function (e) {
    e.preventDefault();
    saveControl()
})


function saveControl() {

    "use strict";

    let req0 = new Promise(function (resolve, reject) {
        let elem = $(`#username`),
            value = elem.val()
        if (value == ""
         || value == undefined
         || value == "none"
        ) {
            reject({
                state: "warning",
                message: "Lütfen Kullanıcı Adı giriniz!",
                errorcode: "CNT001"
            })
            elem.focus()
        } else {
            resolve(value)
        }
    });

    let req1 = new Promise(function (resolve, reject) {
        let elem = $(`#password`),
            value = elem.val()
        if (value == ""
         || value == undefined
         || value == "none"
        ) {
            reject({
                state: "warning",
                message: "Lütfen Şifre giriniz!",
                errorcode: "CNT002"
            })
            elem.focus()
        } else {
            resolve(value)
        }
    });


    Promise.all([req0, req1]).then(function (res) {
        saveProcess(res)
    }).catch(function (err) {
        eastAlert(err);
    });
}



function saveProcess(promiseRes) {
    eastAlert({
        state: "info",
        message: "Giriş Yapılıyor",
        errorcode: "CNT999"
    });

    let username    = promiseRes[0],
        password    = promiseRes[1],


    reqData = {
        USERNAME:   username,
        PASSWORD:   password
    }

    jsonData = JSON.stringify(reqData)
    // console.log(reqData)
    // return;

    let postURL = window.location.origin +
        '/login_process'

    $(".postcheck").attr("disabled", true);
    $.ajax({
        url: postURL,
        type: "POST",
        data: jsonData,
        contentType: "application/json",
        success: function (e) {
            $(".postcheck").attr("disabled", false);

            console.log(e);
            eastAlert(e);

            if (e.state == 'success') {
                $(`input`).val("")
                setTimeout(function() {
                    window.location.href 
                        = window.location.origin 
                            + '/dashboard'
                }, 1200)
            }
        },
        error: function (e) {
            console.log("error");
            console.log(e);
            eastAlert({
                state: "error",
                message: "Bir hata oluştu! Lütfen yetkiliye danışınız!",
                errorcode: "CNT999"
            })
        }
    })
}

function eastAlert(e) {
    $(`#errorDiv`).html("")
    if (e.message != undefined) {
        $(`#errorDiv`).html(e.message)
    }
}