<?php
$listeCandidats = $candidats ?? [];
?>

<h2>Liste des Candidats</h2>
<?php if (empty($listeCandidats)): ?>
    <p>Aucun candidat trouvé.</p>
<?php else: ?>
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Action</th>
        </tr>
        <?php foreach ($listeCandidats as $candidat): ?>
            <tr>
                <td><?= htmlspecialchars((string) $candidat['id'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars((string) $candidat['nom'], ENT_QUOTES, 'UTF-8') ?></td>
                <td>
                    <a href="/etat/sumElecteur/<?= htmlspecialchars((string) $candidat['id'], ENT_QUOTES, 'UTF-8') ?>">
                        Voir total électeurs
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
