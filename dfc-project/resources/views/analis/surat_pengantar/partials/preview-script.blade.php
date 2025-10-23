<style>
    .a4-container {
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .a4-page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 0 auto;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        font-family: 'Calibri', serif;
        font-size: 12pt;
        line-height: 1.5;
    }

    .a4-header,
    .a4-footer {
        text-align: center;
    }

    .a4-body {
        margin: 20px 0;
    }

    .barang-bukti-table {
        width: 100%;
        border-collapse: collapse;
        margin: 15px 0;
    }

    .barang-bukti-table th,
    .barang-bukti-table td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

    .barang-bukti-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .barang-bukti-table .number-col {
        width: 50px;
        text-align: center;
    }

    .barang-bukti-table .bukti-col {
        width: auto;
    }

    @media print {
        .a4-page {
            box-shadow: none;
            margin: 0;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Set today's date in the date field
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggal').value = today;

        // Set today's date in the display element
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const todayDisplay = new Date().toLocaleDateString('id-ID', options);
        document.getElementById('today').textContent = todayDisplay;

        // Ambil template bagian per bagian
        let rawHeader = @json($template->header ?? '<div style="text-align:center;"><h3>INSTANSI</h3></div>');
        let rawBody = @json($template->body ?? '<p>Body template belum diatur</p>');
        let rawFooter = @json($template->footer ?? '<p>Footer belum diatur</p>');

        const TEMPLATE = {
            header: rawHeader,
            body: rawBody,
            footer: rawFooter
        };

        // Debug: Cek template content
        console.log('Template Header:', TEMPLATE.header);
        console.log('Template Body:', TEMPLATE.body);

        function formatDateToLong(dateString) {
            if (!dateString) return '';
            const d = new Date(dateString);
            return d.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
        }

        // PERBAIKAN: Fungsi replace yang lebih komprehensif
        function replacePlaceholders(html, key, val) {
            if (!html) return '';

            // Multiple pattern matching untuk berbagai format placeholder
            const patterns = [
                new RegExp(`\\{\\{\\s*${key}\\s*\\}\\}`, 'gi'),
                new RegExp(`\\{\\{${key}\\}\\}`, 'gi'),
                new RegExp(`\\[${key.toUpperCase()}\\]`, 'g'),     // [NOMOR_SURAT]
                new RegExp(`\\[\\s*${key.toUpperCase()}\\s*\\]`, 'g'), // [ NOMOR_SURAT ]
                new RegExp(`\\$\\{${key}\\}`, 'gi'),               // ${nomor_surat}
            ];

            let result = html;
            patterns.forEach(pattern => {
                result = result.replace(pattern, val);
            });

            return result;
        }

        function buildBarangBuktiTable() {
            const inputs = document.querySelectorAll('[name="barang_bukti[]"]');
            let hasValidItems = false;

            let table = `
                    <table class="barang-bukti-table">
                        <thead>
                            <tr>
                                <th class="number-col">No</th>
                                <th class="bukti-col">Barang Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

            let counter = 1;
            inputs.forEach(el => {
                const v = el.value || '';
                if (v.trim() !== '') {
                    table += `
                            <tr>
                                <td class="number-col">${counter}</td>
                                <td class="bukti-col">${v.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</td>
                            </tr>
                        `;
                    counter++;
                    hasValidItems = true;
                }
            });

            table += `
                        </tbody>
                    </table>
                `;

            if (!hasValidItems) {
                return '<p>Tidak ada barang bukti</p>';
            }

            return table;
        }

        function updatePreview() {
            let header = TEMPLATE.header;
            let body = TEMPLATE.body;
            let footer = TEMPLATE.footer;

            const data = {
                nomor_surat: document.getElementById('nomor_surat')?.value || '',
                tanggal: formatDateToLong(document.getElementById('tanggal')?.value) || '',
                nama_pemohon: document.getElementById('nama_pemohon')?.value || '',
                jabatan_pemohon: document.getElementById('jabatan_pemohon')?.value || '',
                klasifikasi: document.getElementById('klasifikasi')?.value || '',
                barang_bukti: buildBarangBuktiTable(),
            };

            // Debug: Cek data sebelum replace
            console.log('Data sebelum replace:', data);

            // Replace semua placeholder
            Object.keys(data).forEach(key => {
                const originalHeader = header;
                const originalBody = body;
                const originalFooter = footer;

                header = replacePlaceholders(header, key, data[key]);
                body = replacePlaceholders(body, key, data[key]);
                footer = replacePlaceholders(footer, key, data[key]);

                // Debug: Cek perubahan
                if (originalHeader !== header) {
                    console.log(`Replaced ${key} in header`);
                }
                if (originalBody !== body) {
                    console.log(`Replaced ${key} in body`);
                }
            });

            // Debug: Cek hasil akhir
            console.log('Header setelah replace:', header);
            console.log('Body setelah replace:', body);

            document.getElementById('preview-area').innerHTML = `
                    <div class="a4-container">
                        <div class="a4-page">
                            <div class="a4-header">${header}</div>
                            <div class="a4-body">${body}</div>
                            <div class="a4-footer">${footer}</div>
                        </div>
                    </div>
                `;
        }

        // PERBAIKAN: Tambah event listener untuk semua elemen form
        const formElements = [
            'nomor_surat', 'tanggal', 'nama_pemohon', 'jabatan_pemohon', 'klasifikasi'
        ];

        formElements.forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener('input', updatePreview);
                el.addEventListener('change', updatePreview);
            }
        });

        const buktiSection = document.getElementById('barang-bukti-section');
        if (buktiSection) {
            buktiSection.addEventListener('input', function (e) {
                if (e.target.matches('[name="barang_bukti[]"]')) {
                    updatePreview();
                }
            });

            buktiSection.addEventListener('change', function (e) {
                if (e.target.matches('[name="barang_bukti[]"]')) {
                    updatePreview();
                }
            });
        }

        // tombol tambah bukti
        document.getElementById('add-bukti').addEventListener('click', function () {
            const div = document.createElement('div');
            div.className = 'flex gap-2';
            div.innerHTML = `
                    <input type="text" name="barang_bukti[]" class="flex-1 border rounded px-3 py-2" placeholder="Barang bukti tambahan">
                    <button type="button" class="px-3 py-2 bg-red-500 text-white rounded remove-bukti">Hapus</button>
                `;
            buktiSection.appendChild(div);
            updatePreview();
        });

        // Event delegation for remove buttons
        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-bukti')) {
                if (e.target.parentElement !== buktiSection.firstElementChild) {
                    e.target.parentElement.remove();
                    updatePreview();
                }
            }
        });

        // Show remove button for the first item if it has a value
        const firstBuktiInput = document.getElementById('barang_bukti_first');
        if (firstBuktiInput) {
            firstBuktiInput.addEventListener('change', function () {
                const firstRemoveBtn = this.nextElementSibling;
                if (firstRemoveBtn && this.value) {
                    firstRemoveBtn.classList.remove('hidden');
                } else if (firstRemoveBtn) {
                    firstRemoveBtn.classList.add('hidden');
                }
            });

            // Trigger initial state
            if (firstBuktiInput.value) {
                const firstRemoveBtn = firstBuktiInput.nextElementSibling;
                if (firstRemoveBtn) firstRemoveBtn.classList.remove('hidden');
            }
        }

        // initial preview
        updatePreview();
    });
</script>