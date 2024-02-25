$(document).ready(function() {
    processImages()
    setInterval(() => {
        processImages()
    }, 20000);
})


$(document).on(`click`, `#removeAllBtn`, function () {
    $(`#removeAllModal`).modal(`show`);
})


$(document).on(`click`, `#lastDeleteAllRemoveBtn`, function () {
    eastAlert({
        state: "info",
        message: "Tüm Fotoğraflar Siliniyor ...",
        errorcode: "CNT999"
    })


    $.ajax({
        url: window.location.origin + '/dashboard_delete_image_all_process',
        type: "POST",
        contentType: "application/json",
        success: function (e) {
            console.log(e);
            eastAlert(e)
            if (e.state == 'success') {
                $(`#removeAllModal`).modal(`hide`)
                getUploadedImages()
            }
        },
        error: function (e) {
            console.log("error");
            console.log(e);
            eastAlert({
                state: "error",
                message: "Fotoğraflarlar Silinemedi!",
                errorcode: "CNT999"
            })
        }
    })
})


function processImages() {
    console.log("fotoğraflar işleniyor ...");
    $.ajax({
        url: window.location.origin + '/get_photo_process',
        type: "GET",
        success: function (e) {
            if (e == "successful") {
                console.log("fotoğraflar işlendi!");
            }
        },
        error: function (e) {
            console.log("error");
            console.log("fotoğraflar işlenemedi!");
            console.log(e);
        }
    })
}