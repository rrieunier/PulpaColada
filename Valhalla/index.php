<?php
session_start();

if ( ! isset( $_SESSION["admin"] ) && ! $_SESSION["admin"] ) {
	header( "Location: connexion.php" );
}
require "../includes.php";
?>
<!doctype html>
<html lang="fr">
<head>
	<?php head( "Campagne" ); ?>

    <link href="../css/croppie.css" rel="stylesheet"/>
    <script src="../js/croppie.js"></script>
</head>
<body>
<?php navbar( "modifierCompte" ); ?>

<div id="content" class="text-center">
    <section>
        <h1 class="display-4">
            <mark>Modifier mon profil</mark>
        </h1>
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-8">
                <form action="../administrateurs.php?action=modifier" method="post">
                    <input type="text" value="5" name="id" hidden>
                    <div class="row">
                        <div class="form-group col-sm-12 text-left">
                            <label for="email">Ton adresse email</label>
                            <input type="email" class="form-control" id="email" placeholder="ragnar.lodbrok@ensc.fr"
                                   name="email" autocomplete="email" required
                                   value="<?= $_SESSION["admin"]["email"]; ?>">
                        </div>
                    </div>
                    <div class="row text-center">
                        <div class="form-group col-sm-12 text-center">
                            <button type="button" class="btn btn-warning btn-lg wrap mx-3" data-toggle="modal"
                                    data-target="#mdp-modal">
                                Clique ici pour changer ton mot de passe
                            </button>
                        </div>
                        <div class="modal fade" id="mdp-modal" tabindex="-1" role="dialog"
                             aria-labelledby="mdp-modal"
                             aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="mdp-modal">Changer mon mot de passe</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="form-group col-sm-12 col-md-6 text-left">
                                                    <label for="nou-mdp">Mets un nouveau mot de passe ici</label>
                                                    <input type="password" class="form-control" id="nou-mdp"
                                                           placeholder="Fouille dans ta tête" name="noumdp"
                                                           oninput="require(this, 'anc-mdp')" minlength="8">
                                                </div>
                                                <div class="form-group col-sm-12 col-md-6 text-left">
                                                    <label for="anc-mdp">Mets ton mot de passe actuel ici</label>
                                                    <input type="password" class="form-control" id="anc-mdp"
                                                           placeholder="Fouille dans ta tête là aussi" name="ancmdp">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">
                                            Fermer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 text-left">
                            <label for="prenom-form">Ton pr&eacute;nom</label>
                            <input type="text" class="form-control" id="prenom-form" placeholder="Ragnar" name="prenom"
                                   autocomplete="given-name" required
                                   value="<?= $_SESSION["admin"]["prenom"]; ?>"
                                   oninput="document.getElementById('prenom').innerText = this.value;">
                        </div>
                        <div class="form-group col-md-6 text-left">
                            <label for="nom-form">Ton nom</label>
                            <input type="text" class="form-control" id="nom-form" placeholder="Lodbrok" name="nom"
                                   autocomplete="family-name" required
                                   value="<?= $_SESSION["admin"]["nom"]; ?>"
                                   oninput="if(this.value) document.getElementById('nom').innerText = this.value[0];">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 text-left">
                            <label for="poste-form">Ton poste</label>
                            <input type="text" class="form-control" id="poste-form" placeholder="Roi" name="poste"
                                   oninput="document.getElementById('poste').innerText = this.value;" required
                                   value="<?= $_SESSION["admin"]["poste"]; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6 text-center">
                            <input type="file" accept="image/*" id="photo-file" data-crop="#photo-crop"
                                   data-open="#photo-crop-wrap" data-close="#fond-crop-wrap" onchange="readFile(this)"
                                   data-forme="circle" style="display: none;">
                            <input type="text" name="photo" id="photo-form" required hidden
                                   value="<?= 'data:image/png;base64,' . base64_encode( $_SESSION["admin"]["photo"] ) ?>">
                            <label for="photo-file" class="btn btn-outline-success">
                                <i class="fas fa-upload"></i> Ta photo
                            </label>
                        </div>
                        <div class="form-group col-sm-6 text-center">
                            <input type="file" accept="image/*" id="fond-file" data-crop="#fond-crop"
                                   data-open="#fond-crop-wrap" data-close="#photo-crop-wrap" onchange="readFile(this)"
                                   data-forme="square" style="display: none;">
                            <input type="text" name="fond" id="fond-form" required hidden
                                   value="<?= 'data:image/png;base64,' . base64_encode( $_SESSION["admin"]["couverture"] ) ?>">
                            <label for="fond-file" class="btn btn-outline-success">
                                <i class="fas fa-upload"></i> Ton fond
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div id="photo-crop-wrap" style="display: none">
                            <div id="photo-crop"></div>
                            <button class="btn btn-warning" type="button"
                                    onclick="pivoter('photo-crop')"><i class="fas fa-redo"></i>
                            </button>
                        </div>
                        <div id="fond-crop-wrap" style="display: none">
                            <div id="fond-crop"></div>
                            <button class="btn btn-warning" type="button"
                                    onclick="pivoter('fond-crop')"><i class="fas fa-redo"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 text-left">
                            <label for="bio">Ta bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="3" required
                                      placeholder="Je suis Guillaume le Conquérant, roi d'Egypte."><?php if ( ! empty( $_SESSION["admin"]["bio"] ) ) {
									echo $_SESSION["admin"]["bio"];
								} ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12 text-left">
                            <label for="lienFb">
                                Le lien vers ta page <i class="fab fa-facebook-f"></i>acebook
                            </label>

                            <div class="input-group">
                                <input type="url" class="form-control" id="lienFb"
                                       placeholder="https://facebook.com/..."
                                       name="lienFb" value="<?= $_SESSION['admin']['lienFb']; ?>">
                                <div class="input-group-append">
                                    <a class="btn btn-info" href="https://facebook.com/profile" target="_blank">
                                        Voir sur <i class="fab fa-facebook-f"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <button class="btn btn-primary mx-auto" type="submit">Enregistrer</button>
                    </div>
                </form>
            </div>

            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="row">
                    <h2>Aperçu de ta carte sur la page <q>Liste</q></h2>
                </div>
                <div class="row">
                    <div id="fond" class="carte-liste"
                         style="margin-top: 0; <?php if ( $_SESSION["admin"]["couverture"] ) {
						     echo 'background-image: url(data:image/png;base64,' . base64_encode( $_SESSION["admin"]["couverture"] ) . ')';
					     } ?>">
                        <div class="contenu-carte">
                            <div class="cercle-carte">
                                <img src="<?php
								echo ( $_SESSION["admin"]["photo"] ) ? 'data:image/png;base64,' . base64_encode( $_SESSION["admin"]["photo"] )
									: '../img/roman-cool.jpg'; ?>" class="img-fluid rounded-circle"
                                     alt="$membre" id="photo" data-toggle="tooltip" data-placement="top"
                                     title="<?php if ( $_SESSION["admin"]["bio"] ) {
									     echo $_SESSION["admin"]["bio"];
								     } ?>">
                            </div>
                            <p>
                                <span id="prenom"><?= $_SESSION["admin"]["prenom"]; ?></span>
                                <span id="nom"><?= $_SESSION["admin"]["nom"][0]; ?></span>,
                                <span id="poste"><?= $_SESSION["admin"]["poste"]; ?></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function pivoter(id) {
                jQuery('#' + id).croppie('rotate', -90)
            }

            function readFile(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    var $uploadCrop = $($(input).data('crop')).croppie({
                        viewport: {
                            width: 250,
                            height: 250,
                            type: $(input).data('forme')
                        },
                        boundary: {
                            width: 300,
                            height: 300
                        },
                        enableOrientation: true
                    });

                    reader.onload = function (e) {
                        // $('#photo-crop').addClass('ready');
                        $uploadCrop.croppie('bind', {
                            url: e.target.result
                        });
                    };
                    $($(input).data('open')).show('slow');
                    $($(input).data('close')).hide('fast');

                    reader.readAsDataURL(input.files[0]);
                }
                else {
                    alert("Désolé, ton navigateur ne permet pas d'éditer ta photo");
                }
            }

            $('#photo-crop').on('update.croppie', function () {
                $('#photo-crop').croppie('result', {
                    type: 'base64',
                    size: {width: 768, height: 768},
                    circle: false
                }).then(function (result) {
                    jQuery('#photo').attr('src', result);
                    jQuery('#photo-form').val(result).change();
                });
            });

            $('#fond-crop').on('update.croppie', function () {
                $('#fond-crop').croppie('result', {
                    type: 'base64',
                    size: {width: 768, height: 768},
                    circle: false
                }).then(function (result) {
                    jQuery('#fond').css('backgroundImage', "url(" + result + ")");
                    jQuery('#fond-form').val(result).change();
                });
            });

            function require(source, idCible) {
                var cible = document.getElementById(idCible);
                if (source.value) {
                    cible.required = true;
                } else {
                    cible.required = false;
                }
            }
        </script>
    </section>

</div>
<?php footer(); ?>
</body>
</html>