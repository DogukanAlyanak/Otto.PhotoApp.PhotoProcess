
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