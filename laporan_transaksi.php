<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    header("Location: auth/login.php");
    exit;
}

$query = mysqli_query($conn, "SELECT t.*, u.nama FROM transaksi t 
                              JOIN user u ON t.id_user = u.id_user 
                              ORDER BY t.tanggal DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi - Nazwaazhf Skincare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fff0f5;
            padding: 30px;
        }
        h2 {
            color: deeppink;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-pink {
            background-color: hotpink;
            border: none;
            color: white;
            margin-bottom: 20px;
        }
        .btn-print {
            background: linear-gradient(45deg, #ff69b4, #ff1493);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 105, 180, 0.3);
            cursor: pointer;
            margin-left: 10px;
        }
        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 105, 180, 0.5);
            background: linear-gradient(45deg, #ff1493, #dc143c);
        }
        .btn-print:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(255, 105, 180, 0.3);
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }
        
        /* Print styles */
        @media print {
            body {
                background-color: white !important;
                padding: 20px !important;
            }
            .btn-pink, .btn-print {
                display: none !important;
            }
            h2 {
                color: black !important;
            }
        }
        
        /* Popup styles */
        .popup {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            animation: fadeIn 0.3s;
        }
        
        .popup-content {
            background-color: white;
            margin: 15% auto;
            padding: 30px;
            border-radius: 20px;
            width: 300px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            animation: slideIn 0.3s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .popup h3 {
            color: deeppink;
            margin-bottom: 20px;
        }
        
        .popup-buttons {
            margin-top: 20px;
        }
        
        .popup-btn {
            background-color: hotpink;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 15px;
            margin: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .popup-btn:hover {
            background-color: deeppink;
            transform: translateY(-2px);
        }
        
        .popup-btn.cancel {
            background-color: #ccc;
            color: #333;
        }
        
        .popup-btn.cancel:hover {
            background-color: #999;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="dashboard.php" class="btn btn-pink">⬅ Kembali ke Dashboard</a>
    <button class="btn-print" onclick="showPrintPopup()">🖨️ Cetak Laporan</button>
    <h2>Laporan Transaksi</h2>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Total</th>
                <th>Metode</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($query)) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td>Rp<?= number_format($row['total']) ?></td>
                <td><?= isset($row['metode']) ? htmlspecialchars($row['metode']) : '-' ?></td>
                <td><?= $row['tanggal'] ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<!-- Popup Modal -->
<div id="printPopup" class="popup">
    <div class="popup-content">
        <h3>💕 Cetak Laporan</h3>
        <p>Apakah Anda yakin ingin mencetak laporan transaksi?</p>
        <div class="popup-buttons">
            <button class="popup-btn" onclick="printReport()">🖨️ Ya, Cetak</button>
            <button class="popup-btn cancel" onclick="hidePopup()">❌ Batal</button>
        </div>
    </div>
</div>

<script>
    function showPrintPopup() {
        document.getElementById('printPopup').style.display = 'block';
    }
    
    function hidePopup() {
        document.getElementById('printPopup').style.display = 'none';
    }
    
    function printReport() {
        hidePopup();
        
        // Add print date and time
        const now = new Date();
        const printDate = now.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        const printTime = now.toLocaleTimeString('id-ID');
        
        // Create a temporary element to show print info
        const printInfo = document.createElement('div');
        printInfo.innerHTML = `
            <div style="text-align: center; margin: 20px 0; padding: 10px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9;">
                <h4 style="color: deeppink; margin: 0;">Laporan Transaksi - Nazwaazhf Skincare</h4>
                <p style="margin: 5px 0; color: #666;">Dicetak pada: ${printDate} pukul ${printTime}</p>
            </div>
        `;
        
        // Insert the print info before the table
        const table = document.querySelector('.table');
        table.parentNode.insertBefore(printInfo, table);
        
        // Print the page
        window.print();
        
        // Remove the print info after printing
        setTimeout(() => {
            printInfo.remove();
        }, 1000);
    }
    
    // Close popup when clicking outside
    window.onclick = function(event) {
        const popup = document.getElementById('printPopup');
        if (event.target === popup) {
            hidePopup();
        }
    }
</script>

</body>
</html>
