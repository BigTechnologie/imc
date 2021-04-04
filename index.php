<?php

require "src/dataDB.php";
require "src/historique_items_delete.php";

gen_cookie_user_id();
$db_result = requete_select();




?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="google-site-verification" content="4NDpwT1tj8SidGqaCyBYErC8DV9FVcwMhjoNt6Y2Fsw" />
    <meta name="Perdre du poids & gain de poids " content="Perdre du poids et vérifier réglièrement sans souci grace à cette application utile" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="utf-8">
    <title>Vérifiez votre indice IMC &amp; POIDS</title>
</head>

<body>
    <div class="big-header">
        <h1>Vérifiez votre POIDS &amp; indice IMC </h1>
    </div>

    <div class="group-all">
        <div class="header_info">

            <p class="header_description">Indice de masse corporelle (IMC) permet d'évaluer rapidement votre corpulence
                en utilisant une methode de calcul simple et éfficace et aussi vous permet de suivre votre corpulence
                tout au long d'un régime alimentaire .
            </p>
        </div>

        <div class="indicateur">
            <div class="div-denutrition">
                <p class="denutrition">Dénutrition</p>
                <p id="doigt-denutrition" class="doigt" style="display: none">&#9757;</p>
                <p class="p-graduation"><span class="imc_graduation_denutrition">16.50</span></p>
            </div>
            <div class="div-maigreur">
                <p class="maigreur">Maigreur</p>
                <p id="doigt-maigreur" class="doigt" style="display: none">&#9757;</p>
                <p class="p-graduation"><span class="imc_graduation_maigreur">18.50</span></p>
            </div>
            <div class="div-normal">
                <p class="normal">Normal</p>
                <p id="doigt-normal" class="doigt" style="display: none">&#9757;</p>
                <p class="p-graduation"><span class="imc_graduation_normal">25</span></p>
            </div>
            <div class="div-surpoids">
                <p class="surpoids">surpoids</p>
                <p id="doigt-surpoids" class="doigt" style="display: none">&#9757;</p>
                <p class="p-graduation"><span class="imc_graduation_surpoids">30</span></p>
            </div>
            <div class="div-obesite">
                <p class="obesite">Obésité</p>
                <p id="doigt-obesite" class="doigt" style="display: none">&#9757;</p>
                <p class="p-graduation"><span class="imc_graduation_obesite">40</span></p>
            </div>
            <div class="div-massive">
                <p class="massive">Obésité massive</p>
                <p id="doigt-massive" class="doigt" style="display: none">&#9757;</p>
                <!-- <p><span class="imc_graduation_massive">+</span></p> -->
            </div>

        </div>
        <div class="container_group">
            <div class="group-form">
                <h2 class="titre_imc">Calculez votre IMC </h2>
                <p><small>Indice de Masse Corporelle</small></p>
                <p id="error" class="error" style="display: none"></p>
                <img id="chargement" src="img/chargementColor.gif" alt="chargement..." style="display: none;">
                <form id="idForm" method="post">
                    <input type="text" id="nom" placeholder="Entrez votre Pseudo" maxlength="20" autofocus autocomplete="off">
                    <input id="poids" type="number" placeholder="Entrez votre poids en Kg" autocomplete="off">
                    <input id="taille" type="number" placeholder="Entrez votre taille en cm" autocomplete="off">
                    <button id="btn">Calcul IMC</button>
                </form>
            </div>
            <div class="group-res">
                <h2 id="res_imc">Resultat Traité !</h2>
                <hr>
                DESCRIPTION:<h3 id="description_affiche">Non</h3>
                IMC:<h3 id="imc_affiche">0</h3>
                POIDS:<h3 id="poids_affiche">0</h3>
                TAILLE:<h3 id="taille_affiche">0</h3>

            </div>
        </div>
        <div class='group-table'>
            <h4>Historique </h4><i id="refresh" class="fa fa-refresh" style="color: red;cursor:pointer">refresh</i>
            <table class="table">
                <thead>
                    <tr>
                        <th>PSEUDO</th>
                        <th>POIDS</th>
                        <th>IMC</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>

                </thead>
                <tbody>
                    <form id="formReq" method="post">
                        <?php if ($db_result) : ?>
                            <?php foreach ($db_result  as $data_db) : ?>

                                <tr>
                                    <td><?= $data_db["pseudo"] ? $data_db["pseudo"] : "vide" ?></td>
                                    <td><?= $data_db["poids"] ? $data_db["poids"] . 'kg' : "vide" ?></td>
                                    <td><?= $data_db["imc"] ? $data_db["imc"] : "vide" ?></td>
                                    <td id="create_at"><small><?= $data_db["create_at"] ? $data_db["create_at"] : "vide" ?></small></td>
                                    <input type="hidden" name="delete_item" value="<?= $data_db['id'] ?>">
                                    <td><button id="delete" type="submit">supp</button></td>
                                </tr>


                            <?php endforeach ?>
                        <?php endif ?>
                    </form>
                </tbody>


            </table>

        </div>
        <div class="group-reference">
            <div style="color: black;">
                <h4>Référence</h4>

                <table class="table-reference">
                    <tbody class="table-body-reference">
                        <tr>
                            <td>
                                <p class="couleur_ref_famine"></p>
                            </td>
                            <td>imc &lt; 16.50 </td>
                            <td>Dénutrition Ou Famine</td>

                        </tr>
                        <tr>
                            <td>
                                <p class="couleur_ref_maigreur"></p>
                            </td>
                            <td>16.50 &lt;= imc &lt;= 18.50</td>
                            <td>Maigreur</td>
                        </tr>
                        <tr>
                            <td>
                                <p class="couleur_ref_normal"></p>
                            </td>
                            <td>18.50 &lt;= imc &lt;= 25</td>
                            <td>Corpulence Normale</td>
                        </tr>
                        <tr>
                            <td>
                                <p class="couleur_ref_surpoids"></p>
                            </td>
                            <td>25 &lt;= imc &lt;= 30</td>
                            <td>Surpoids</td>
                        </tr>
                        <tr>
                            <td>
                                <p class="couleur_ref_obesite"></p>
                            </td>
                            <td>30 &lt;= imc &lt;= 40</td>
                            <td>Obésité</td>
                        </tr>
                        <tr>
                            <td>
                                <p class="couleur_ref_massive"></p>
                            </td>
                            <td>40 &lt; imc </td>
                            <td>Obésité Massive</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="footer">
        <div class="resultat">

            <table>
                <thead>
                    <tr>
                        <th>Pseudo</th>
                    </tr>
                    <tr>
                        <th>IMC</th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td id="affiche_resultat"></td>
                    </tr>
                    <tr>
                        <td id="affiche_imc"></td>
                    </tr>

                </tbody>
            </table>
            <button id="reset">Reset</button>
        </div>

        <div id="div_bonne_annee" class="bonne_annee" style="display: none;">
            <p id="full_year"></p>
            <img id=meilleur_voeux src="img/meilleurs-voeux.gif" alt="meilleurs-voeux">
        </div>

    </div>


    <script src="element.js"></script>

</body>

</html>