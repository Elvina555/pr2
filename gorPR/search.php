<?php
// Подключение к базе данных
$servername = "localhost"; // Имя сервера
$username = "root";        // Имя пользователя БД
$password = "";            // Пароль пользователя БД
$dbname = "Sport";       // Имя базы данных

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем параметр поиска из формы
    $search = $conn->real_escape_string($_POST['search']);

    // SQL-запрос для поиска книги
    $sql = "SELECT * FROM `Тренировки` WHERE `Название` LIKE '%$search%' OR `Время` LIKE '%$search%' OR `Продолжительность` LIKE '%$search%' OR `Номер_зала` LIKE '%$search%' OR `Стоимость` LIKE '%$search%'";
    $result = $conn->query($sql);

    // Проверяем, есть ли результаты
    if ($result->num_rows > 0) {
        // Выводим данные о книгах
        echo "<h2>Результаты поиска:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Номер</th>
                    <th>Название</th>
                    <th>Время</th>
                    <th>Продолжительность</th>
                    <th>Номер_зала</th>
                    <th>Стоимость</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["Номер"] . "</td>
                    <td>" . $row["Название"] . "</td>
                    <td>" . $row["Время"] . "</td>
                    <td>" . $row["Продолжительность"] . "</td>
                    <td>" . $row["Номер_зала"] . "</td>
                    <td>" . $row["Стоимость"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Тренировка не найдена.</p>";
    }
}

// Закрываем подключение
$conn->close();
?>