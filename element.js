
var poids = document.querySelector('#poids');
var taille = document.querySelector("#taille");
var nom = document.querySelector("#nom");
var error = document.querySelector("#error");
var chargement = document.querySelector("#chargement");

var btn = document.querySelector("#btn");

var doigt_denutrition = document.querySelector("#doigt-denutrition");
var doigt_maigreur = document.querySelector("#doigt-maigreur");
var doigt_normal = document.querySelector("#doigt-normal");
var doigt_surpoids = document.querySelector("#doigt-surpoids");
var doigt_obesite = document.querySelector("#doigt-obesite");
var doigt_massive = document.querySelector("#doigt-massive");

var imc_affiche = document.querySelector("#imc_affiche");
var poids_affiche = document.querySelector("#poids_affiche");
var taille_affiche = document.querySelector("#taille_affiche");
var description_affiche = document.querySelector("#description_affiche");

var delete_item = document.querySelector('#delete');




refresh_list()
bonne_annee()
input_value_bigger()
doigt_horizontal()

//  delete_item.addEventListener('click', delete_position)




btn.addEventListener('click', function (e) {

    e.preventDefault()

    if (taille.value == '' || poids.value == '') {

        error.innerHTML = " Les champs sont vides ! ";
        error.style.display = "block";
        error.style.backgroundColor = "";

    } else {



        input_value_bigger()
        data()
        hauteur_vu_smart()



    }

})

// function delete_position() {

//     // var supp =  confirm("Voulez vous vraiment supprimer l'element ?")
//     //  if(supp)
//     // var x = document.clientX;
//     // var y = document.clientY;

//     // window.scrollTo(x, y)
// }


function data() {
    chargement.style.display = "block"

    setTimeout(function () {

        error.style.display = "block";
        error.style.backgroundColor = "green";
        error.innerHTML = "Données traitées avec succès !";



        var xhr = new XMLHttpRequest();
        xhr.open("GET", "src/data.php?taille=" + taille.value + "&& poids=" + poids.value + "&& nom=" + nom.value, true)
        xhr.onreadystatechange = function (e) {

            if (xhr.readyState === 4 && xhr.status === 200) {

                const word_split = xhr.responseText.split(',');

                if (word_split[3] == "Dénutrition Ou Famine") {

                    display_elements(doigt_denutrition, "block", doigt_maigreur, doigt_normal, doigt_surpoids, doigt_obesite, doigt_massive, 'none')

                    display_data(
                        imc_affiche,
                        poids_affiche,
                        taille_affiche,
                        description_affiche, word_split[0], word_split[1], word_split[2], word_split[3], "#ff1a1a")


                } else if (word_split[3] == "Maigreur") {

                    display_elements(doigt_maigreur, "block", doigt_denutrition, doigt_normal, doigt_surpoids, doigt_obesite, doigt_massive, 'none')

                    display_data(
                        imc_affiche,
                        poids_affiche,
                        taille_affiche,
                        description_affiche, word_split[0], word_split[1], word_split[2], word_split[3], "#ff6600")



                } else if (word_split[3] == "Corpulence Normale") {


                    display_elements(doigt_normal, "block", doigt_maigreur, doigt_denutrition, doigt_surpoids, doigt_obesite, doigt_massive, 'none')

                    display_data(
                        imc_affiche,
                        poids_affiche,
                        taille_affiche,
                        description_affiche, word_split[0], word_split[1], word_split[2], word_split[3], "#33cc33")


                } else if (word_split[3] == "Surpoids") {

                    display_elements(doigt_surpoids, "block", doigt_maigreur, doigt_normal, doigt_denutrition, doigt_obesite, doigt_massive, 'none')

                    display_data(
                        imc_affiche,
                        poids_affiche,
                        taille_affiche,
                        description_affiche, word_split[0], word_split[1], word_split[2], word_split[3], "#990099")



                } else if (word_split[3] == "Obésité") {

                    display_elements(doigt_obesite, "block", doigt_maigreur, doigt_normal, doigt_surpoids, doigt_denutrition, doigt_massive, 'none')

                    display_data(
                        imc_affiche,
                        poids_affiche,
                        taille_affiche,
                        description_affiche, word_split[0], word_split[1], word_split[2], word_split[3], "#993300")


                } else if (word_split[3] == "Obésité Massive") {

                    display_elements(doigt_massive, "block", doigt_maigreur, doigt_normal, doigt_surpoids, doigt_obesite, doigt_denutrition, 'none')

                    display_data(
                        imc_affiche,
                        poids_affiche,
                        taille_affiche,
                        description_affiche, word_split[0], word_split[1], word_split[2], word_split[3], "#cc0000")
                }





            }
        }
        xhr.send()
        chargement.style.display = "none"
    }, 2000);

}


function display_elements(actif, displayStatus, actif1, actif2, actif3, actif4, actif5, none) {

    actif.style.display = displayStatus
    actif1.style.display = none
    actif2.style.display = none
    actif3.style.display = none
    actif4.style.display = none
    actif5.style.display = none
}
//affichage des données 

function display_data(queryEl1, queryEl2, queryEl3, queryEl4, data1, data2, data3, data4, color) {

    queryEl1.innerHTML = "<p style=color:" + color + ">" + data1 + "</p>"
    queryEl2.innerHTML = "<p style=color:" + color + ">" + data2 + "</p>"
    queryEl3.innerHTML = "<p style=color:" + color + ">" + data3 + "</p>"
    queryEl4.innerHTML = "<p style=color:" + color + ">" + data4 + "</p>"
}


function bonne_annee() {
    var full_year = document.querySelector('#full_year');
    var div_bonne_annee = document.querySelector("#div_bonne_annee");

    var date = new Date();

    var month = date.getMonth()
    if (month == 0) {
        div_bonne_annee.style.display = "block";
        full_year.innerHTML = "BONNE ANNEE " + date.getFullYear();

    }
}



function input_value_bigger() {


    poids.style.fontSize = "20px"
    taille.style.fontSize = "20px"
    nom.style.fontSize = "20px"

}


function doigt_horizontal() {

    if (window.innerWidth <= 600) {

        doigt_denutrition.innerHTML = "&#128073;"
        doigt_maigreur.innerHTML = "&#128073;"
        doigt_normal.innerHTML = "&#128073;"
        doigt_surpoids.innerHTML = "&#128073;"
        doigt_obesite.innerHTML = "&#128073;"
        doigt_massive.innerHTML = "&#128073;"
    }



}

function hauteur_vu_smart() {
    if (window.innerWidth <= 600) {

        window.scrollTo(scrollY, 80)
    } else if (window.innerWidth > 600 && window.innerWidth <= 820) {
        window.scrollTo(scrollY, 120)
    }
}


function refresh_list() {

    var refresh_list_items = document.querySelector("#refresh");
    refresh_list_items.addEventListener('click', function () {


        location.reload();
        return false
    });

}
// delete_historique()

// function delete_historique() {


//     document.querySelectorAll("#delete").forEach(function (link) {

//         link.addEventListener('click', function (ev) {
//             ev.preventDefault(false)

//             link_param = new URLSearchParams(link.search)
//             if (link_param.has('s')) {

//                 console.log(link_param.get('s'));
//             }

//         })


//     })



// }