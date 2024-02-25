
$(document).on(`click`, `#imageLibrary .remove-file-btn`, function () {
    let filename = $(this).parent().attr("filename");
    $(`.remove-modal-img`).attr(`src`, window.location.origin + "/public/fullscreen/" + filename)
    $(`.remove-modal-img`).attr(`filename`, filename)
    $(`#removeModal`).modal(`show`)
})

$(document).on(`click`, `#lastDeleteBtn`, function () {
    let filename = $(`.remove-modal-img`).attr(`filename`)
    deleteImageProcess(filename)
})

function deleteImageProcess(filename) {
    eastAlert({
        state: "info",
        message: "Fotoğraf Siliniyor",
        errorcode: "CNT999"
    })

    reqData = {
        IMAGE:  filename
    }

    jsonData = JSON.stringify(reqData)
    
    $.ajax({
        url: window.location.origin + '/dashboard_delete_image_process',
        data: jsonData,
        type: "POST",
        contentType: "application/json",
        success: function (e) {
            console.log(e);
            eastAlert(e)
            
            if (e.state == 'success') {
                $(`#removeModal`).modal(`hide`)
                getUploadedImages()
            }
        },
        error: function (e) {
            console.log("error");
            console.log(e);
            eastAlert({
                state: "error",
                message: "Yüklenen Fotoğraflar Silinemedi!",
                errorcode: "CNT999"
            })
        }
    })
}