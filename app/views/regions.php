<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Regions</title>
    <link rel="stylesheet" href="/public/css/main.css">
</head>
<body>
    <?php require_once 'components/header.php'; ?>
    <section class="content">
        <h1>Regions List</h1>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Region</th>
                <th>Population</th>
                <th>Higher Education Institutions</th>
            </tr>
            <tbody>
            <?php if (!empty($regions)) : ?>
                <?php foreach ($regions as $regionData) : ?>
                    <tr>
                        <td><?= htmlspecialchars($regionData->id); ?></td>
                        <td><?= htmlspecialchars($regionData->name); ?></td>
                        <td><?= htmlspecialchars($regionData->population); ?></td>
                        <td><?= htmlspecialchars($regionData->higherEducationInstitutions); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3">No regions found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </section>
    <?php require_once 'components/footer.php'; ?>
</body>
</html>