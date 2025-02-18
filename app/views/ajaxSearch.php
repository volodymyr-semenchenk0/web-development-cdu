<?php
$title = "Пошук по Foxtrot";
require_once 'components/head.php';
?>
<body>
    <?php require_once 'components/header.php'; ?>
    <div id="root">
        <h1>Пошук продуктів на сайті - Foxtrot</h1>
        <div class="content-wrapper">
            <div class="content-wrapper__form">
                <label for="searchInput">Пошуковий запит</label>
                <input type="text" id="searchInput" placeholder="Введіть запит...">
            </div>
        </div>
        <div id="searchResults" class="search-results"></div>
    </div>
    <script>
        document.getElementById('searchInput').addEventListener('keypress', function () {
            const query = this.value.trim();

            if (!query) {
                document.getElementById('searchResults').innerHTML = '';
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('GET', `/search?query=${encodeURIComponent(query)}`, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        document.getElementById('searchResults').innerHTML = xhr.responseText;
                    } else {
                        document.getElementById('searchResults').innerHTML = `<div class="error">Помилка: ${xhr.statusText}</div>`;
                    }
                }
            };

            xhr.onerror = function () {
                document.getElementById('searchResults').innerHTML = `<div class="error">Помилка запиту</div>`;
            };

            xhr.send();
        });
    </script>
    <?php require_once 'components/footer.php'; ?>
</body>