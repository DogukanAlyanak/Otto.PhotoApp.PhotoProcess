
var uploadedImages = []

$(document).ready(function () {
    getUploadedImages()
    setInterval(() => {
        getUploadedImages()
    }, 20000);
})

function getUploadedImages() {
    $.ajax({
        url: window.location.origin + '/dashboard_get_images_process',
        type: "POST",
        contentType: "application/json",
        success: function (e) {
            console.log(e);

            if (e.state == 'success') {
                uploadedImages = e.data
                sortPhotos()
                sortPhotosWait(e.data2)
            }

        },
        error: function (e) {
            console.log("error");
            console.log(e);
            eastAlert({
                state: "error",
                message: "Yüklenen Fotoğraflar Getirilemedi! Lütfen yetkiliye danışınız!",
                errorcode: "CNT999"
            })
        }
    })
}

function sortPhotos() {
    let allimages = []
    if (allimages.length < 1) {
        $(`#imageLibrary`).html("");
    }
    $.each(uploadedImages, function (i, filename) {
        let fileUrl = window.location.origin + "/public/fullscreen/" + filename
        let fileComp = `<div class="col-lg-3 col-md-4 col-sm-12 file-item" filename="${filename}">
            <button type="button" class="btn btn-sm remove-file-btn">
                <i class="fa-regular fa-trash-can"></i>
            </button>
            <img src="${fileUrl}" alt="file"></div>`;
        allimages.push(fileComp)

        if (uploadedImages.length - 1 == i) {
            $(`#imageLibrary`).html(allimages);
        }
    })
}

function sortPhotosWait(data) {
    let allimages = []
    if (allimages.length < 1) {
        $(`#waitImageLibrary`).html("");
    }
    $.each(data, function (i, filename) {
        let fileUrl = window.location.origin + "/upload/" + filename
        let fileComp = `<div class="col-lg-3 col-md-4 col-sm-12 file-item">
            <img src="${fileUrl}" alt="file"></div>`;
        allimages.push(fileComp)

        if (data.length - 1 == i) {
            $(`#waitImageLibrary`).html(allimages);
        }
    })
}