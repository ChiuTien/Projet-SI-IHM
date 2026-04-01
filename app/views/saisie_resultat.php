<?php
$etatsList = $etats ?? [];
$candidatsList = $candidats ?? [];
$rows = $classement ?? [];
$selectedId = (int) ($selectedEtatId ?? 0);
$flashMessage = $message ?? '';

$tableData = [];

foreach ($rows as $row) {
    $nomEtat = (string) ($row['nom_etat'] ?? 'Inconnu');
    $nomCandidat = (string) ($row['nom_candidat'] ?? 'Inconnu');
    $pourcentage = (float) ($row['pourcentage'] ?? 0);

    if (!isset($tableData[$nomEtat])) {
        $tableData[$nomEtat] = [];
    }

    $tableData[$nomEtat][$nomCandidat] = number_format($pourcentage, 2, ',', ' ') . '%';
}
?>

<style>
    body {
        font-family: sans-serif;
        background: #ececec;
        color: #101010;
    }

    .result-page {
        max-width: 900px;
        margin: 30px auto;
        padding: 10px 20px;
    }

    h2 {
        text-align: center;
        margin-bottom: 28px;
    }

    .result-form {
        max-width: 480px;
        margin: 0 auto 40px;
    }

    .field-row {
        display: grid;
        grid-template-columns: 1fr 180px;
        align-items: center;
        gap: 14px;
        margin-bottom: 14px;
    }

    .field-row select,
    .field-row input {
        border: 2px solid #222;
        background: #f5f5f5;
        padding: 8px 10px;
        font-size: 16px;
        width: 100%;
        box-sizing: border-box;
    }

    .submit-wrap {
        text-align: right;
        margin-top: 10px;
    }

    .submit-wrap button {
        border: 2px solid #222;
        background: #d4d4d4;
        padding: 8px 22px;
        font-size: 20px;
        cursor: pointer;
    }

    .flash {
        text-align: center;
        margin: 0 0 16px;
        font-weight: 700;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #efefef;
    }

    th,
    td {
        border: 2px solid #222;
        padding: 14px 10px;
        text-align: left;
        font-size: 18px;
    }

    th {
        background: #d0d0d0;
    }
</style>

<div class="result-page">
    <h2>Saisie Resultat</h2>

    <?php if ($flashMessage !== ''): ?>
        <p class="flash"><?= htmlspecialchars((string) $flashMessage, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

    <form class="result-form" method="post" action="/resultat/saisie">
        <div class="field-row">
            <label for="id_etat">Choisir Etat</label>
            <select id="id_etat" name="id_etat" required>
                <option value="">Selectionner</option>
                <?php foreach ($etatsList as $etat): ?>
                    <?php
                    $etatId = (int) ($etat['id'] ?? 0);
                    $etatNom = (string) ($etat['nom_etat'] ?? 'Inconnu');
                    ?>
                    <option value="<?= htmlspecialchars((string) $etatId, ENT_QUOTES, 'UTF-8') ?>" <?= $selectedId === $etatId ? 'selected' : '' ?>>
                        <?= htmlspecialchars($etatNom, ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php foreach ($candidatsList as $candidatItem): ?>
            <?php
            $candidatId = (int) ($candidatItem['id'] ?? 0);
            $candidatNom = (string) ($candidatItem['nom'] ?? 'Inconnu');
            ?>
            <div class="field-row">
                <label for="vote_<?= htmlspecialchars((string) $candidatId, ENT_QUOTES, 'UTF-8') ?>">
                    <?= htmlspecialchars($candidatNom, ENT_QUOTES, 'UTF-8') ?>
                </label>
                <input
                    id="vote_<?= htmlspecialchars((string) $candidatId, ENT_QUOTES, 'UTF-8') ?>"
                    type="number"
                    min="0"
                    step="1"
                    name="votes[<?= htmlspecialchars((string) $candidatId, ENT_QUOTES, 'UTF-8') ?>]"
                    value="0"
                    required
                >
            </div>
        <?php endforeach; ?>

        <div class="submit-wrap">
            <button type="submit">Valider</button>
        </div>
    </form>

    <?php if (!empty($tableData)): ?>
        <table>
            <tr>
                <th>Etat</th>
                <?php foreach ($candidatsList as $candidatItem): ?>
                    <th><?= htmlspecialchars((string) ($candidatItem['nom'] ?? 'Inconnu'), ENT_QUOTES, 'UTF-8') ?></th>
                <?php endforeach; ?>
            </tr>
            <?php foreach ($tableData as $etatNom => $candidateValues): ?>
                <tr>
                    <td><?= htmlspecialchars((string) $etatNom, ENT_QUOTES, 'UTF-8') ?></td>
                    <?php foreach ($candidatsList as $candidatItem): ?>
                        <?php
                        $nom = (string) ($candidatItem['nom'] ?? 'Inconnu');
                        $value = $candidateValues[$nom] ?? '0,00%';
                        ?>
                        <td><?= htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8') ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
