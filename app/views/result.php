<?php
$nomCandidat = $candidat['nom'] ?? 'Inconnu';
$totalElecteurs = $sum ?? 0;
?>

<h2>Resultat</h2>
<table>
    <tr>
        <th>Candidat</th>
        <th>Nombre d'electeurs</th>
    </tr>
    <tr>
        <td><?= htmlspecialchars((string) $nomCandidat) ?></td>
        <td><?= htmlspecialchars((string) $totalElecteurs) ?></td>
    </tr>
</table>

