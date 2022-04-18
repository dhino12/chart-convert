<?php 

include 'functions.php';

$jumlah_teknik = query('SELECT * FROM mahasiswa WHERE fakultas="teknik"');
$jumlah_ekonomi = query("SELECT * FROM mahasiswa WHERE fakultas='ekonomi'");
$jumlah_fisip = query("SELECT * FROM mahasiswa WHERE fakultas='fisip'");
$jumlah_pertanian = query("SELECT * FROM mahasiswa WHERE fakultas='pertanian'");

$tables = query('SHOW TABLES;');

?>

<script>
     
    const grafikCanvas = document.querySelector('#canvas-grafik');
    let wrapperCanvas, canvas, title;
    
    /** 
     * menulis canvas berdasarkan data table dynamic dari database 
     * */
    /** 
    <?php foreach ($tables as $key => $table) : ?>
        
        wrapperCanvas = document.createElement('div');
        canvas = document.createElement('canvas');
        title = document.createElement('h5'); 
        wrapperCanvas.setAttribute('class', 'col-xl-5 d-flex flex-column');

        title.innerText = "Grafik <?= $key+1 ?>";
        canvas.setAttribute('id', 'myChart<?= $key+1 ?>');
        wrapperCanvas.appendChild(title);
        wrapperCanvas.appendChild(canvas);
        grafikCanvas.appendChild(wrapperCanvas);

        console.log(`data <?= $key ?>`);

    <?php endforeach; ?>
    */

    /** 
     * Chart
     */
    const ctx = document.getElementById('myChart1').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Teknik', 'Fisip', 'Ekonomi', 'Pertanian'],
            datasets: [{
                label: 'Data Mahasiswa',
                borderRadius: [11,11,11,11],
                data: [ 
                        <?= count($jumlah_teknik); ?>,
                        <?= count($jumlah_ekonomi); ?>,
                        <?= count($jumlah_fisip); ?>,
                        <?= count($jumlah_pertanian); ?>,
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1,
                borderSkipped: false,
            }]
        },
        options: {
            scales: {
                y: {
                    ticks: {
                        beginAtZero:true
                    }
                }
            },
            plugins: {
                datalabels: {
                    color: '#00',
                    anchor: 'end',
                    align: 'end',
                }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>