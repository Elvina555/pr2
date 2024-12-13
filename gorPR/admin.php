<?php
$servername = "127.0.0.1";
$username = "root";
$password = ""; 
$dbname = "Sport";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $time = $_POST['time'];
    $duration = $_POST['duration']; 
    $num = $_POST['num'];
    $price = $_POST['price'];

    // Corrected SQL query
    $sql = "INSERT INTO `Тренировки`(`Название`, `Время`, `Продолжительность`, `Номер_зала`, `Стоимость`) 
    VALUES ('$name','$time','$duration','$num','$price')";
        
    if ($conn->query($sql) === TRUE) {
        echo "<script> 
        alert('Тренировка добавлена!'); 
        window.location.href = 'admin.html';
        exit();			
        </script>";
    } else {
        // Corrected error handling
        echo "<script> 
        alert('Ошибка при вставке: " . $conn->error . "'); 
        window.location.href = 'admin.html'; 
        </script>";
    }    
}
$conn->close();
?>