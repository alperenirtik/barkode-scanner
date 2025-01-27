<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- SEO Meta Etiketleri -->
    <title>Barkod Tarama Sistemi - Hızlı ve Kolay Barkod Okuyucu</title>
    <meta name="description" content="Mobil cihazınızın kamerasını kullanarak hızlı ve kolay bir şekilde barkod tarama işlemi yapın. Ücretsiz, hızlı ve kullanıcı dostu barkod okuyucu.">
    <meta name="keywords" content="barkod tarama, barkod okuyucu, qr kod okuyucu, mobil barkod, kamera ile barkod">
    <meta name="author" content="Barkod Tarama Sistemi">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
   
    <!-- Scripts ve Stylesheets -->
    <script src="barkod.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <!-- Toast Bildirim -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="cameraPermissionToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Kamera izni başarıyla verildi!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Kapat"></button>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <h1 class="card-title text-center mb-5">
                            <i class="bi bi-upc-scan me-2"></i>
                            Barkod Tarama Sistemi
                        </h1>
                        
                        <div class="d-grid gap-3 d-sm-flex justify-content-center mb-5">
                            <button id="allowCameraButton" class="btn btn-info px-4 py-3">
                                <i class="bi bi-camera-fill me-2"></i>
                                Kamera İzni Ver
                            </button>
                            <button id="scanButton" class="btn btn-success px-4 py-3">
                                <i class="bi bi-qr-code-scan me-2"></i>
                                Tarama Yap
                            </button>
                        </div>

                        <div class="how-it-works">
                            <h5 class="section-title">
                                <i class="bi bi-info-circle-fill me-2"></i>
                                Nasıl Çalışır?
                            </h5>
                            <div class="steps-container">
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="bi bi-camera"></i>
                                    </div>
                                    <h6>Kamera İzni</h6>
                                    <p>Cihazınızın kamerasına erişim izni verin</p>
                                </div>
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="bi bi-upc-scan"></i>
                                    </div>
                                    <h6>Barkodu Okutun</h6>
                                    <p>Barkodu kamera görüş alanına getirin</p>
                                </div>
                                <div class="step">
                                    <div class="step-icon">
                                        <i class="bi bi-clipboard-check"></i>
                                    </div>
                                    <h6>Sonucu Alın</h6>
                                    <p>Barkod değerini görüntüleyin ve kopyalayın</p>
                                </div>
                            </div>
                        </div>

                        <div class="footer-buttons mt-5">
                            <a href="https://www.alperenirtik.com/" target="_blank" class="footer-btn">
                                <i class="bi bi-person-circle"></i>
                                Kişisel Web Sitem
                            </a>
                            <a href="https://www.ankasoftyazilim.com/" target="_blank" class="footer-btn">
                                <i class="bi bi-building"></i>
                                Firma Sitem
                            </a>
                        </div>

                        <hr class="my-4">

                        <div class="demo-note text-center mb-4">
                            <p class="text-muted mb-3">Bu proje, barkod tarama işlevselliğini gösteren örnek bir çalışmadır.</p>
                            <a href="https://github.com/alperenirtik/barcode-scanner" target="_blank" class="github-btn">
                                <i class="bi bi-github"></i>
                                GitHub'da İncele
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Barcode Scanning -->
    <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="scanModalLabel">
                        <i class="bi bi-upc-scan text-primary me-2"></i>
                        Barkod Tarama
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <div class="video-container mb-4">
                        <video id="video" class="shadow-sm" autoplay></video>
                        <div class="scan-overlay">
                            <div class="scan-line"></div>
                        </div>
                    </div>
                    
                    <div class="barcode-container">
                        <input type="text" id="barcode" readonly placeholder="Taranıyor...">
                        <button type="button" id="copyButton">
                            <i class="bi bi-clipboard"></i>
                            Kopyala
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
