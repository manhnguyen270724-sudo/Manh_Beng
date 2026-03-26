<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=quan_ly_san_pham', 'root', '');
    echo "✓ Kết nối MySQL thành công!\n";
    
    // Lấy thông tin bảng
    $result = $pdo->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'quan_ly_san_pham'");
    $tables = $result->fetchAll(PDO::FETCH_COLUMN);
    
    echo "\nBảng có trong cơ sở dữ liệu:\n";
    foreach ($tables as $table) {
        echo "  - " . $table . "\n";
    }
} catch (Exception $e) {
    echo "✗ Lỗi kết nối: " . $e->getMessage() . "\n";
}
?>
