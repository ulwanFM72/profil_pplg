import Chart from 'chart.js/auto';

const { galeri, asset } = window.dashboardData ?? {};
const opts = { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } };

if (galeri) {
    new Chart(document.getElementById('chartGaleri'), {
        type: 'bar', data: { labels: galeri.labels, datasets: [{ data: galeri.values, backgroundColor: '#E53935' }] }, options: opts,
    });
}
if (asset) {
    new Chart(document.getElementById('chartAsset'), {
        type: 'bar', data: { labels: asset.labels, datasets: [{ data: asset.values, backgroundColor: '#4D96FF' }] }, options: opts,
    });
}
