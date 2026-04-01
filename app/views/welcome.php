<?php include __DIR__ . '/layouts/header.php' ?>

<?php
    $firstCandidate = $candidats[0] ?? ['nomCandidat' => 'Joe', 'prenomCandidat' => 'Biden'];
    $secondCandidate = $candidats[1] ?? ['nomCandidat' => 'Donald', 'prenomCandidat' => 'Trump'];

    $firstCandidateName = trim(($firstCandidate['nomCandidat'] ?? '') . ' ' . ($firstCandidate['prenomCandidat'] ?? ''));
    $secondCandidateName = trim(($secondCandidate['nomCandidat'] ?? '') . ' ' . ($secondCandidate['prenomCandidat'] ?? ''));

    $selectedEtat = $formData['etat'] ?? '';
    $votesC1 = $formData['votes_c1'] ?? '';
    $votesC2 = $formData['votes_c2'] ?? '';
?>

<main class="welcome-layout">
    <form class="vote-form-box" method="post" action="<?= BASE_URL ?>/">
        <div class="field-row centered-row">
            <select id="etat-select" name="etat" required>
                <option value="">Choisir Etat</option>
                <?php foreach ($etats as $etat): ?>
                    <option value="<?= (int) $etat['idEtat'] ?>" <?= $selectedEtat === (string) $etat['idEtat'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($etat['nomEtat'], ENT_QUOTES, 'UTF-8') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="field-row">
            <label for="votes-c1"><?= htmlspecialchars($firstCandidateName, ENT_QUOTES, 'UTF-8') ?></label>
            <input id="votes-c1" name="votes_c1" type="number" min="0" step="1" value="<?= htmlspecialchars((string) $votesC1, ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="field-row">
            <label for="votes-c2"><?= htmlspecialchars($secondCandidateName, ENT_QUOTES, 'UTF-8') ?></label>
            <input id="votes-c2" name="votes_c2" type="number" min="0" step="1" value="<?= htmlspecialchars((string) $votesC2, ENT_QUOTES, 'UTF-8') ?>" required>
        </div>

        <div class="field-row centered-row">
            <button id="validate-votes" type="submit">Valider</button>
        </div>

        <?php if (!empty($errorMessage)): ?>
            <p><?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8') ?></p>
        <?php endif; ?>
    </form>

    <section class="result-box">
        <table id="result-table">
            <thead>
                <tr>
                    <th>Etat</th>
                    <th><?= htmlspecialchars($firstCandidateName, ENT_QUOTES, 'UTF-8') ?></th>
                    <th><?= htmlspecialchars($secondCandidateName, ENT_QUOTES, 'UTF-8') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($resultRow)): ?>
                    <tr>
                        <td><?= htmlspecialchars($resultRow['etat'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($resultRow['c1'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($resultRow['c2'], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td>...</td>
                        <td>...</td>
                        <td>...</td>
                    </tr>
                <?php endif; ?>