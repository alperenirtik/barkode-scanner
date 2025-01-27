const codeReader = new ZXing.BrowserBarcodeReader();
const videoElement = document.getElementById('video');
const barcodeInput = document.getElementById('barcode');
const barcodeResult = document.getElementById('barcode-result');
const scanModal = document.getElementById('scanModal');
const closeModal = document.querySelector('.close');
const scanButton = document.getElementById('scanButton');
const allowCameraButton = document.getElementById('allowCameraButton');
const copyButton = document.getElementById('copyButton');

// Kamera izni ver butonuna tıklanırsa
allowCameraButton.addEventListener('click', function() {
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            // Toast bildirimi göster
            const toast = new bootstrap.Toast(document.getElementById('cameraPermissionToast'));
            toast.show();

            // Stream'i durdur
            stream.getTracks().forEach(track => track.stop());

            // 2 saniye sonra sayfayı yenile
            setTimeout(() => {
                location.reload();
            }, 2000);
        })
        .catch(err => {
            console.error('Kamera erişimi hatası:', err);
            alert('Kamera erişimi sağlanamadı. Lütfen kameraya izin verin.');
        });
});

// Modal işlemleri için Bootstrap Modal nesnesini kullan
const scanModalElement = document.getElementById('scanModal');
const scanModalInstance = new bootstrap.Modal(scanModalElement);

// Tarama işlemi başlatıldığında
scanButton.addEventListener('click', function() {
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        alert('Bu tarayıcı kamerayı desteklemiyor.');
        return;
    }

    // Modal'ı göster
    scanModalInstance.show();

    // Tarayıcıdaki kamera cihazlarını alın
    codeReader.getVideoInputDevices().then(videoInputDevices => {
        if (videoInputDevices.length > 0) {
            let rearCamera = videoInputDevices.find(device =>
                device.label.toLowerCase().includes('back')
            );

            // Eğer arka kamera bulunmazsa ilk cihazı kullan
            if (!rearCamera) {
                rearCamera = videoInputDevices[0];
            }

            // Kamera akışını başlat
            navigator.mediaDevices.getUserMedia({
                video: {
                    deviceId: rearCamera.deviceId,
                    facingMode: 'environment',
                    width: { ideal: 1280 },
                    height: { ideal: 720 }
                }
            }).then(stream => {
                videoElement.srcObject = stream;

                // Barkod tarama işlemi
                codeReader.decodeFromVideoDevice(rearCamera.deviceId, videoElement, result => {
                    if (result) {
                        const barcodeValue = result.getText();
                        barcodeInput.value = barcodeValue;
                        barcodeResult.value = barcodeValue; // Ana sayfadaki input'u da güncelle
                    }
                });
            }).catch(err => {
                console.error('Kamera kullanımı hatası:', err);
                alert('Kamera kullanılamadı.');
            });
        }
    });
});

// Modal kapanma işlemi
scanModalElement.addEventListener('hidden.bs.modal', function() {
    const stream = videoElement.srcObject;
    if (stream) {
        const tracks = stream.getTracks();
        tracks.forEach(track => track.stop());
        videoElement.srcObject = null;
    }
});

// Kopyalama butonu işlevselliği
copyButton.addEventListener('click', function() {
    const barcodeValue = barcodeInput.value;
    if (barcodeValue) {
        navigator.clipboard.writeText(barcodeValue).then(() => {
            // Kopyalama başarılı olduğunda butonun görünümünü güncelle
            const button = this;
            const originalContent = button.innerHTML;
            button.innerHTML = '<i class="bi bi-clipboard-check"></i> Kopyalandı';
            button.classList.add('copied');

            // 2 saniye sonra butonu eski haline getir
            setTimeout(() => {
                button.innerHTML = originalContent;
                button.classList.remove('copied');
            }, 2000);
        }).catch(err => {
            console.error('Kopyalama hatası:', err);
            alert('Kopyalama işlemi başarısız oldu.');
        });
    }
});