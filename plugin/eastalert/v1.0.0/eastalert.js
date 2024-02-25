// Default Variables
var alertCounter = 0;

// Alertin değişkenlerini ata, Alana Yazdır ve Başlat
function runEastAlert(e1, e2, e3) {
    ++alertCounter
    let counter = alertCounter
    let alertDiv = eastAlert1(e1, e2, e3, counter)
    $('.ertalert').append(alertDiv)
    setTimeout(() => {
        $(`#alertCount${counter}`).css('display', 'none')
        $(`#alertCount${counter}`).html('')
    }, 5000);    
}

function ertAlert(res) {
    eastAlert(res)
}



// Hangi Alert Kontrol Et ve Başlat
function eastAlert(res) {
    if (res.state == 'success') {
       //console.log(res.state + ' - ' + res.message)
        runEastAlert('İşlem Başarılı!', res.message, 'success')
    } else if (res.state == 'warning') {
       //console.log(res.state + ' - ' + res.message)
        runEastAlert('Uyarı!', res.message, 'warning')
    } else if (res.state == 'info') {
       //console.log(res.state + ' - ' + res.message)
        runEastAlert('Bilgilendirme!', res.message, 'info')
    } else {
       //console.log(res.state + ' - ' + res.message)
        runEastAlert('Hata!', res.message, 'error')
    }

    if (res.state == 'warning' || res.state == 'error') {
        console.log(`Hata Kodu: ` + res.errorcode);
    }
}


// Alert Türleri
function eastAlert1(e1, e2, e3, counter) {
    if (e3 == 'success') {
        var message1 = e1
        var message2 = e2
        var alerttext 
            =   `<div id="alertCount${counter}" class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa-solid fa-check mr-2" aria-hidden="true"></i> ${message1} ${message2}
                </div>`
        return alerttext
    }
    if (e3 == 'warning') {
        var message1 = e1
        var message2 = e2
        var alerttext 
            =   `<div id="alertCount${counter}" class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa-regular fa-brake-warning mr-2" aria-hidden="true"></i> ${message1} ${message2}
                </div>`
        return alerttext
    }
    if (e3 == 'error') {
        var message1 = e1
        var message2 = e2
        var alerttext 
            =   `<div id="alertCount${counter}" class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa-solid fa-circle-exclamation mr-2" aria-hidden="true"></i> ${message1} ${message2}
                </div>`
        return alerttext
    }
    if (e3 == 'info') {
        var message1 = e1
        var message2 = e2
        var alerttext 
        =   `<div id="alertCount${counter}" class="alert alert-info" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="fa-solid fa-info mr-2" aria-hidden="true"></i> ${message1} ${message2}
            </div>`
        return alerttext
    }
}

function eastErrorAlert(res) {
    if (navigator.onLine == false) {
        eastAlert({
            state: "error",
            errorcode: "EEA001",
            message: "İnternet Bağlantısı Kurulamadı!",
        })
        return
    }

    if (res.status == 500 || res.status == 0) {
        eastAlert({
            state: "error",
            errorcode: "EEA002",
            message: "Sunucu Bağlantısı Kurulamadı!",
        })
        return
    }

        eastAlert({
            state: "error",
            errorcode: "EEA003",
            message: "İşlem Gerçekleşti, Ancak Sonuç bildirilmedi!",
        })
        return
}