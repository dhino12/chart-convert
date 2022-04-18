<?php 

include 'queryHandler.php';

$jumlah_teknik = mysqli_query($conn,'SELECT * FROM mahasiswa WHERE fakultas="teknik"');
$jumlah_ekonomi = mysqli_query($conn,"SELECT * FROM mahasiswa WHERE fakultas='ekonomi'");
$jumlah_fisip = mysqli_query($conn,"SELECT * FROM mahasiswa WHERE fakultas='fisip'");
$jumlah_pertanian = mysqli_query($conn,"SELECT * FROM mahasiswa WHERE fakultas='pertanian'");

$data = query('SHOW TABLES;');
var_dump($data);
?>

<script>
    var ctx = document.getElementById('myChart1').getContext('2d');
    console.log(ctx);
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Teknik', 'Fisip', 'Ekonomi', 'Pertanian'],
            datasets: [{
                label: 'Data Mahasiswa',
                borderRadius: [11,11,11,11],
                data: [ 
                        <?= mysqli_num_rows($jumlah_teknik); ?>,
                        <?= mysqli_num_rows($jumlah_ekonomi); ?>,
                        <?= mysqli_num_rows($jumlah_fisip); ?>,
                        <?= mysqli_num_rows($jumlah_pertanian); ?>,
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