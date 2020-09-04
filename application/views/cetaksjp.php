<!DOCTYPE html>
<html lang="en"><head>
<link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?>">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Document</title>
<style>
table {
border-collapse: collapse;
width: 100%;

}

th, td {
text-align: left;
padding: 5px;
}

tr:nth-child(even){background-color: #ecf0f1; }

th {
background-color: #bdc3c7;
color: #000;
}
</style>
</head><body>
  <img src='.$img_kop.' alt="" width="100%" />

<h4 style="text-align: justify;"><br /><span style="color: #171717; font-family: 'times new roman', times, serif;">&nbsp; &nbsp;Berdasarkan surat dari Kementerian Kesehatan Republik Indonesia No.UM.01.05/5.11/1883/2020 tanggal 13 April 2020 tentang Hasil Pemeriksaan Sampel COVID-19, maka kami sampaikan hasil pemeriksaan sampel yang diperiksa di Laboratorium Balai Besar Teknik Kesehatan Lingkungan Dan Pengendalian Penyakit Jakarta pada 4 &ndash; 10 April 2020.</span></h4>
<h4 style="text-align: justify;"><span style="color: #171717; font-family: 'times new roman', times, serif;">Demikian kami sampaikan atas perhatian dan kerjasama Bapak/Ibu kami ucapkan</span><br /><span style="color: #171717; font-family: 'times new roman', times, serif;">terima kasih.&nbsp;</span></h4>
<h4>
<!--         <span>Nama</span><span>:</span><span>   <?= $Nama; ?></span>
-->    </h4>


<br>
<br>
<?php foreach ($pejabat as $pjb) : ?>
<pre style="text-align: right; padding-left: 40px;"><strong><?= $pjb['jabatan']; ?></strong><br /><strong>KOTA DEPOK</strong></pre>
<p style="text-align: right;"><img src="" alt="" width="228" height="57" /></p>
<p style="text-align: right;"><br /><strong><?= $pjb['nama_pejabat']; ?></strong></p>
</p>
<?php endforeach; ?>
<br>


<br>
<br>
<br>
<br>

<br>
<br>
<br>
<br>

<br>
<br>
<br>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>  <br>
<br>
<br>
<br>
<br>

<!-- <table border="1">
<tr>
<th>Id Khasus</th>
<th>Nama</th>
<th>Tanggal</th>
</tr>
<?php foreach ($pasiens as $wyt) : ?>
<tr>
<td><?= $wyt['Status']; ?></td>
<td><?= $wyt['Nama']; ?></td>
<td><?= $wyt['TanggalStatus']; ?></td>
</tr>


<?php endforeach; ?>
</table> -->
</body></html>
