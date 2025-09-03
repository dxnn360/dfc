document.addEventListener("DOMContentLoaded", function () {
    const hari = [
        "Minggu",
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jumat",
        "Sabtu",
    ];
    const bulan = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    ];

    const today = new Date();
    const namaHari = hari[today.getDay()];
    const tanggal = today.getDate();
    const namaBulan = bulan[today.getMonth()];
    const tahun = today.getFullYear();

    document.getElementById(
        "today"
    ).textContent = `${namaHari}, ${tanggal} ${namaBulan} ${tahun}`;
});
