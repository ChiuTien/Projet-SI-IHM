<?php include __DIR__ . '/layouts/header.php' ?>

<main>
    <section>
        <p>
            <label for="etat">Choix de l'etat:</label>
            <select name="etat" id="etat">
                <?php foreach ($etats as $etat): ?>
                    <option value="<?= (int) $etat['idEtat'] ?>"><?= htmlspecialchars($etat['nomEtat'], ENT_QUOTES, 'UTF-8') ?></option>
                <?php endforeach; ?>
            </select>
        </p>
    </section>

    <section>
        <h2>Tableau des candidats</h2>
        <table id="candidats-table">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Age</th>
                <th>Voix (etat selectionne)</th>
            </tr>
            <?php foreach ($candidats as $candidat): ?>
                <tr>
                    <td><?= (int) $candidat['idCandidat'] ?></td>
                    <td><?= htmlspecialchars($candidat['nomCandidat'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($candidat['prenomCandidat'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= (int) $candidat['ageCandidat'] ?></td>
                    <td class="voix-cell" data-candidat-id="<?= (int) $candidat['idCandidat'] ?>">-</td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
</main>

<?php include __DIR__ . '/layouts/footer.php' ?>