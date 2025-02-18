<?php
$title = "Пошук по IP";
require_once 'components/head.php';
?>
<body>
<?php require_once 'components/header.php'; ?>
<div id="root">
    <h1>Пошук інформації по IP</h1>
    <form id="ipForm" class="content-wrapper content-wrapper__form" method="POST">
        <label for="ipInput">Введіть IP-адресу</label>
        <input type="text" id="ipInput" name="ip" placeholder="Введіть IP адрес..." required>
        <button class="button button__primary" type="submit">Знайти Інформацію</button>
    </form>
    <pre id="result"></pre>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const ipv4Regex = /^(25[0-5]|2[0-4]\d|1\d{2}|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d{2}|[1-9]?\d)){3}$/;

        $('#ipForm').on('submit', function(e) {
            e.preventDefault();
            let ip = $('#ipInput').val().trim();

            if (!ipv4Regex.test(ip)) {
                alert('Введіть коректну IP-адресу');
                return;
            }

            $.ajax({
                url: '/ip-info/json',
                type: 'POST',
                dataType: 'json',
                data: { ip: ip },
                success: function(response) {
                    if (response.message === "reserved range") {
                        alert("Введена IP-адреса знаходиться в зарезервованому діапазоні");
                        return;
                    }

                    let countryCode = response.countryCode || '';
                    let country     = response.country || '';
                    let region      = response.region || '';
                    let regionName  = response.regionName || '';
                    let city        = response.city || '';
                    let postalCode  = response.zip || '';
                    let lat         = response.lat || '';
                    let lon         = response.lon || '';

                    // Формуємо HTML з потрібною інформацією
                    // Зверніть увагу, що для прапорця можна використовувати зображення
                    // "flags/ua.png", якщо у вас є каталог flags з назвами за ISO-кодами.
                    let output  = `<p><strong>Country Code:</strong> ${countryCode}</p>`;
                    output     += `<p><strong>Flag:</strong> <img src="images/flags_ISO_3166-1/${countryCode.toLowerCase()}.png" alt="Flag" onerror="this.onerror=null; this.src='images/flags_ISO_3166-1/_unitednations.png';"/></p>`;
                    output     += `<p><strong>Country Name:</strong> ${country}</p>`;
                    output     += `<p><strong>Region:</strong> ${region}</p>`;
                    output     += `<p><strong>Region Name:</strong> ${regionName}</p>`;
                    output     += `<p><strong>City:</strong> ${city}</p>`;
                    output     += `<p><strong>Postal Code:</strong> ${postalCode}</p>`;
                    output     += `<p><strong>Latitude:</strong> ${lat}</p>`;
                    output     += `<p><strong>Longitude:</strong> ${lon}</p>`;

                    // Вставляємо результат у блок #result
                    $('#result').html(output);
                },
                error: function(xhr, status, error) {
                    $('#result').text('Сталася помилка: ' + error);
                }
            });
        });
    });
</script>
<?php require_once 'components/footer.php'; ?>
</body>