<?php include __DIR__ . '/layouts/header.php' ?>

<main>
    <section>
        <h2>Importer un fichier TXT</h2>

        <?php if (!empty($message)): ?>
            <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/index.php/import-txt" method="post" enctype="multipart/form-data">
            <label for="txt_file">Fichier .txt</label>
            <input type="file" name="txt_file" id="txt_file" accept=".txt,text/plain" required>
            <button type="submit">Importer</button>
        </form>

        <?php if (!empty($preview)): ?>
            <h3>Apercu</h3>
            <pre><?= htmlspecialchars($preview, ENT_QUOTES, 'UTF-8') ?></pre>
        <?php endif; ?>
    </section>
</main>

<?php include __DIR__ . '/layouts/footer.php' ?>
