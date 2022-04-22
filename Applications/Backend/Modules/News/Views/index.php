<p style="text-align: center">Il y a actuellement <?php echo
$nombreNews; ?> news. En voici la liste :</p>
<table class="table-bordered table-admin-news">
    <tr>
        <th>Auteur</th>
        <th>Titre</th>
        <th>Date d'ajout</th>
        <th>Dernière modification</th>
        <th>Action</th>
    </tr>
<?php
    foreach ($listeNews as $news) {
        echo '
              <tr>
                <td>', $news['auteur'], '</td>
                <td>', $news['titre'], '</td>
                <td>le ', $news['dateAjout']->format('d/m/Y à H\hi'), '</td>
                <td>', ($news['dateAjout'] == $news['dateModif'] ? '-' : 'le '.$news['dateModif']->format('d/m/Y à H\hi')), '</td>
                <td>
                    <a href="news-update-', $news['id'], '.php" class="btn btn-primary m-1">modifier</a> 
                    <a href="news-delete-', $news['id'], '.php" class="btn btn-danger m-1">supprimer</a>
                </td>
              </tr>', "\n";
              
    }?>
</table>