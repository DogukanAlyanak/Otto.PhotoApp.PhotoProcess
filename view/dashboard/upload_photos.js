Dropzone.autoDiscover = false;
var images = []
const imageAcceptFileFormats = ["image/jpeg", "image/png"]
const imageAcceptFileFormatExts = ["jpeg", "jpg", "png"]

$(document).ready(function () {
    $("#imageUploadDropzone").dropzone({
        url: window.location.origin + "/dashboard_upload_image_process",
        acceptedFiles: "image/jpeg,image/png",
        // disablePreviews: true,
        autoProcessQueue: true,
        // autoProcessQueue: false,
        init: function () {
            this.on("addedfiles", function (files) {
                let dzone = this
                let fileext

                $.each(files, function(i, item) {
                    fileext = item.name.split(`.`)[1].toLowerCase();

                    if (item.size > 32000000) {
                        eastAlert({
                            state: "warning",
                            message: `Dosyalar yüklenemedi! Dosya Boyutu 32 MB den büyük olamaz!`,
                            errorcode: "CNT003"
                        })
                        return false;
                    } else if (imageAcceptFileFormats.includes(item.type) == false) {
                        eastAlert({
                            state: "warning",
                            message: `Dosyalar yüklenemedi! Yalnızca jpeg ve png formatları desteklenmektedir!`,
                            errorcode: "CNT002"
                        })
                        return false;
                    } else if (imageAcceptFileFormatExts.includes(fileext) == false) {
                        eastAlert({
                            state: "warning",
                            message: `Dosyalar yüklenemedi! Yalnızca jpeg ve png formatları desteklenmektedir!`,
                            errorcode: "CNT003"
                        })
                        return false;
                    } else {
                        $.each(files, function(i, item) {
                            dzone.processQueue();
                        })
                    }
                })
            });
        },
        success: function (file, res) {
            getUploadedImages()
            /* eastAlert({
                state: "info",
                message: "Fotoğraflar Yükleniyor!",
                errorcode: "CNT998"
            }) */
        },
        error: function (res) {
            eastAlert({
                state: "error",
                message: "Fotoğraf Yüklenemedi!",
                errorcode: "CNT999"
            })
        }
    });
})