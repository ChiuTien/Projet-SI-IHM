<?php include __DIR__ . '/layouts/header.php' ?>

<main>
    <section>
        <p>Choix de l'etat: <select name="etat" id="etat">
            <?php foreach ($etats as $etat): ?>
                <option value="<?= $etat->getId() ?>"><?= $etat->getNom() ?></option>
            <?php endforeach; ?>
        </select></p>
    </section>
</main>

<?php include __DIR__ . '/layouts/footer.php' ?>