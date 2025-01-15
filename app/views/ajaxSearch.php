<?php
$title = "Пошук по Foxtrot";
require_once 'components/head.php';
?>
<body>
    <?php require_once 'components/header.php'; ?>
    <div id="root">
        <h1>Search products on the Foxtrot Website</h1>
        <div class="content-wrapper">
            <div class="content-wrapper__form">
                <label for="searchInput">Пошуковий запит</label>
                <input type="text" id="searchInput" placeholder="Введіть запит...">
            </div>
        </div>
        <div id="searchResults" class="search-results"></div>
    </div>
    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            const query = this.value.trim();

            if (!query) {
                document.getElementById('searchResults').innerHTML = '';
                return;
            }

            fetch(`/search?query=${encodeURIComponent(query)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Помилка: ${response.statusText}`);
                    }
                    return response.text();
                })
                .then(data => {
                    document.getElementById('searchResults').innerHTML = data;
                })
                .catch(error => {
                    document.getElementById('searchResults').innerHTML = `<div class="error">${error.message}</div>`;
                });
        });
    </script>
    <?php require_once 'components/footer.php'; ?>
</body>