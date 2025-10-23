<x-app-layout>
    <div class="px-6 py-8">
        <h2 class="text-xl font-semibold mb-4">Preview Surat Tugas (HTML)</h2>
        <div class="bg-gray-100 rounded-lg shadow p-4 flex justify-center overflow-auto">
            <div class="a4-container">
                <div class="a4-page">
                    <div class="a4-header">
                        <div class="nomor-surat font-bold mb-2">
                            {{ $surat_tugas->nomor_surat }}
                        </div>
                        {!! $header !!}
                    </div>
                    <div class="a4-body">
                        {!! $body !!}
                    </div>
                    <div class="a4-footer">
                        {!! $footer !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .a4-container {
            width: 210mm;
            min-height: 297mm;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            position: relative;
        }

        .a4-page {
            padding: 25mm;
            height: 100%;
            display: flex;
            flex-direction: column;
            font-family: 'Calibri', serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        .a4-header {
            text-align: center;
            margin-bottom: 10mm;
            border-bottom: 2px solid #000;
            padding-bottom: 5mm;
        }

        .a4-body {
            flex: 1;
            text-align: justify;
        }

        .a4-footer {
            margin-top: auto;
            border-top: 1px solid #000;
            padding-top: 5mm;
            text-align: center;
            font-size: 10pt;
        }

        @media print {
            .a4-container {
                box-shadow: none;
                width: 210mm;
                height: 297mm;
            }
        }
    </style>
</x-app-layout>
