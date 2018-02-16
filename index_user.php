<?php
/**
 * Created by PhpStorm.
 * User: cdi
 * Date: 12/02/2018
 * Time: 10:41
 */

include "inc/header.php";

$skills = ["Java", "JavaScript", "PHP", "HTML", "CSS", "Symfony", "C", "C++", "SQL", "Kahoot"];
$establishments = ["CEFIM", "Lycée Lamotte Beuvron", "PolyTech Tours"];
$mostSearchs = ["Java", "PHP", "JS"];
$persons = [array(
    "firstname" => "Jean-Lou",
    "lastname" => "LEBARS",
    "email" => "jllebars@cefim.eu",
    "cellphone" => "0678912345",
    "establishment" => "CEFIM",
    "picture" => "img/user_icon.png"
), array(
    "firstname" => "Jean Bernard",
    "lastname" => "Le Tekos",
    "email" => "jbletekos@gmail.com",
    "cellphone" => "0606060606",
    "establishment" => "Lycée Lamotte Beuvron",
    "picture" => "img/user_icon.png"
), array(
    "firstname" => "Charles",
    "lastname" => "DeMogency",
    "email" => "charlesedemogency@demogency.com",
    "cellphone" => "0698754321",
    "establishment" => "PolyTech Tours",
    "picture" => "img/user_icon.png"
)];


?>


<div class="container">
    <div class="row">
        <div class="col-3">
            <img class="img-fluid" src="img/SkillZ.png" alt="logo skillz">
            <div>
                <h6 style="margin-top: 30%">Compétences</h6>
                <div style="max-height: 8em; overflow-y: auto">
                    <? foreach ($skills as $skill) : ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="<?= $skill ?>">
                            <label class="form-check-label"><?= $skill ?></label>
                            <span class="badge badge-primary badge-pill"><? if ($skill == "Java" || $skill == "PHP") : echo(3); endif; ?></span>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
            <br>
            <div>
                <h6>Lieux</h6>
                <div style="max-height: 8em; overflow-y: auto">
                    <? foreach ($establishments as $establishment) : ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="<?= $establishment ?>">
                            <label class="form-check-label"><?= $establishment ?></label>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="container-fluid">
                <h6>Les recherches les plus fréquentes...</h6>
                <div class="btn-block">
                    <? foreach ($mostSearchs as $mostSearch) : ?>
                        <button type="button" class="btn btn-light"><?= $mostSearch ?></button>
                    <? endforeach; ?>
                </div>
            </div>
            <br>
            <div class="container-fluid">
                <h6>Les derniers profils ajoutés...</h6>
                <div class="card-deck">
                    <? foreach ($persons as $person) : ?>
                        <div class="card">
                            <img class="card-img-top" src="<?= $person[picture] ?>" alt="user_picture">
                            <div class="card-body">
                                <h5 class="card-title"><?= $person[firstname] . " " . $person[lastname] ?></h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <small class="card-text text-muted">Etablissement</small>
                                        <p class="card-text"><?= $person[establishment] ?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <small class="card-text text-muted">Email</small>
                                        <p class="card-text"><?= $person[email] ?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <small class="card-text text-muted">Téléphone</small>
                                        <p class="card-text"><?= $person[cellphone] ?></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>

            </div>
        </div>
    </div>

    <? include "inc/footer.php"; ?>