<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MangsaPadi (SEED) - Deteksi AI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .loader {
            border-top-color: #16a34a;
            -webkit-animation: spinner 1.5s linear infinite;
            animation: spinner 1.5s linear infinite;
        }
        @keyframes spinner {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-4xl mx-auto px-4 py-4 flex justify-center items-center">
            <span class="text-2xl font-bold text-green-600 flex items-center gap-2">
                🌾 SEED <span class="text-gray-400 text-sm font-normal">| MangsaPadi</span>
            </span>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center p-4">
        <div class="max-w-xl w-full bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

            <div class="bg-green-600 p-6 text-center text-white">
                <h1 class="text-2xl font-bold mb-1">Deteksi Penyakit Padi</h1>
                <p class="text-green-100 text-sm">Unggah foto daun atau malai, AI kami akan menganalisisnya dalam hitungan detik.</p>
            </div>

            <div class="p-6 md:p-8">

                <div id="errorBox" class="hidden bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
                    <p id="errorText" class="text-sm text-red-700 font-medium"></p>
                </div>

                <div id="resultArea" class="hidden animate-fade-in-up">
                    <div class="relative rounded-xl overflow-hidden mb-6 group border border-gray-200 shadow-sm">
                        <img id="resultImage" src="" alt="Foto Analisis" class="w-full h-56 object-cover object-center">
                    </div>

                    <div class="text-center mb-6">
                        <h3 class="text-xs font-bold tracking-wider text-gray-500 uppercase mb-2">Hasil Analisis AI</h3>
                        <p id="resultName" class="text-3xl font-extrabold text-gray-800 mb-2">-</p>

                        <div class="flex items-center justify-center gap-3 mt-4">
                            <span class="text-sm font-medium text-gray-600">Akurasi:</span>
                            <div class="w-1/2 bg-gray-200 rounded-full h-2.5">
                                <div id="resultBar" class="bg-green-500 h-2.5 rounded-full" style="width: 0%"></div>
                            </div>
                            <span id="resultAccuracy" class="text-sm font-bold text-green-600">0%</span>
                        </div>
                    </div>

                    <button onclick="resetForm()" class="w-full flex justify-center py-3.5 px-4 border border-gray-300 rounded-xl shadow-sm text-sm font-bold text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        🔍 Pindai Daun Lainnya
                    </button>
                </div>

                <form id="uploadForm" class="space-y-6">
                    <div class="flex items-center justify-center w-full">
                        <label for="foto_padi" class="flex flex-col items-center justify-center w-full h-56 border-2 border-green-300 border-dashed rounded-xl cursor-pointer bg-green-50 hover:bg-green-100 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <span class="text-4xl mb-3">📸</span>
                                <p class="mb-2 text-sm text-green-800 font-semibold">Klik untuk unggah foto</p>
                                <p class="text-xs text-green-600">Format: JPG, PNG (Maks. 2MB)</p>
                            </div>
                            <input id="foto_padi" name="foto_padi" type="file" class="hidden" accept="image/jpeg, image/png, image/jpg" required onchange="previewFileName(this)" />
                        </label>
                    </div>

                    <div id="fileNameDisplay" class="text-center text-sm font-medium text-gray-600 hidden"></div>

                    <div class="relative">
                        <button type="submit" id="submitBtn" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-md text-base font-bold text-white bg-green-600 hover:bg-green-700 transition-colors">
                            🚀 Mulai Analisis AI
                        </button>

                        <div id="loadingIndicator" class="hidden absolute inset-0 flex items-center justify-center bg-green-700 rounded-xl">
                            <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-6 w-6 mr-3"></div>
                            <span class="text-white font-bold">AI Sedang Bekerja...</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="text-center py-6 text-gray-400 text-xs">
        <p>Hak Cipta &copy; 2026 Tim <strong>PECINTASAWIT</strong>. Dirancang untuk Hackathon.</p>
    </footer>

    <script>
        // Endpoint API Laravel kamu (Sesuaikan port jika berbeda)
        const API_URL = 'http://127.0.0.1:8000/api/v1/diagnosa';

        function previewFileName(input) {
            const display = document.getElementById('fileNameDisplay');
            if (input.files && input.files[0]) {
                display.textContent = "File terpilih: " + input.files[0].name;
                display.classList.remove('hidden');
            }
        }

        function resetForm() {
            document.getElementById('uploadForm').reset();
            document.getElementById('uploadForm').classList.remove('hidden');
            document.getElementById('resultArea').classList.add('hidden');
            document.getElementById('fileNameDisplay').classList.add('hidden');
            document.getElementById('errorBox').classList.add('hidden');
        }

        document.getElementById('uploadForm').addEventListener('submit', async function(e) {
            e.preventDefault(); // Mencegah halaman reload

            const fileInput = document.getElementById('foto_padi');
            if (!fileInput.files[0]) return;

            // Tampilkan Loading
            document.getElementById('submitBtn').classList.add('hidden');
            document.getElementById('loadingIndicator').classList.remove('hidden');
            document.getElementById('errorBox').classList.add('hidden');

            // Siapkan data foto
            const formData = new FormData();
            formData.append('foto_padi', fileInput.files[0]);

            try {
                // Tembak ke Laravel REST API
                const response = await fetch(API_URL, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok && data.status === 'success') {
                    // Berhasil! Sembunyikan form, tampilkan hasil
                    document.getElementById('uploadForm').classList.add('hidden');
                    document.getElementById('resultArea').classList.remove('hidden');

                    // Isi data dari API ke layar HTML
                    document.getElementById('resultName').textContent = data.data.penyakit;
                    document.getElementById('resultAccuracy').textContent = data.data.akurasi + '%';
                    document.getElementById('resultBar').style.width = data.data.akurasi + '%';

                    // Untuk foto, buat object URL lokal agar langsung muncul
                    document.getElementById('resultImage').src = URL.createObjectURL(fileInput.files[0]);
                } else {
                    // Tampilkan pesan error dari Laravel
                    throw new Error(data.message || 'Terjadi kesalahan pada server.');
                }
            } catch (error) {
                document.getElementById('errorBox').classList.remove('hidden');
                document.getElementById('errorText').textContent = error.message;
            } finally {
                // Sembunyikan Loading
                document.getElementById('submitBtn').classList.remove('hidden');
                document.getElementById('loadingIndicator').classList.add('hidden');
            }
        });
    </script>
</body>
</html>
