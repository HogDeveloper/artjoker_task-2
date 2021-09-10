<h1>Home page</h1>

<main>
    <section>
        <h2><?= $title ?></h2>
        <p>Data from table: <?= $useTable ?></p>
        <ul>
            <li>Data from db: <?= $result["column_1"] ?></li>
            <li>Data from db: <?= $result["column_2"] ?></li>
            <li>Data from db: <?= $result["column_3"] ?></li>
            <li>Data from db: <?= $result["column_4"] ?></li>
        </ul>
    </section>
</main>