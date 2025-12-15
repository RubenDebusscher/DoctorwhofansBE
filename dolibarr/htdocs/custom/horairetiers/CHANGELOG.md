# CHANGELOG pour le module Dolibarr :  [HoraireTiers](https://git.code42.io/dolibarr/modules/project/suite-services/horairetiers/-/tree/master)

Toutes les modifications notables apportées à ce projet seront documentées dans ce fichier.

Le format est basé sur [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
et ce projet adhère au [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

# <span style='color:white;background-color:#ed6b00;border-radius:5px;padding: 5px;font-size:small'>Nouveautés</span> [v.16.0.00] - 2023-07-11

- Fixed :
  - [#35] Si H2G2 est manquant, une erreur est retournée

# [v.14.0.02] - 2022-09-05

- Fixed :
  - [H2G2 - #44] Nettoyage SweetAlert2 et ajout de la page migrations

# [v.14.0.01] - 2022-04-12

* Changed :
   * [#57] La version minimum requise pour H2G2 est la v15.0.00
   
# [v.14.0.00] - 2022-04-06

* Changed :
   * Compatibilité du module avec Dolibarr 14
   
# [v.13.2.02] - 2022-03-16

* Added :
  * Ajout d'un picto sur les onglets Horaires

* Changed :
  * Modification du nom des onglets présents sur tiers, ticket et intervention en Horaires

# [v.13.2.01] - 2021-12-14

* Added :
  * Mise en place d'une bannière d'info dans l'onglet horaires d'ouvertures du tiers
  * Ajout d'une légende sur les inputs
  * Ajout d'un placeholder sur les inputs
  
* Fixed :
  * Modification des messages d'erreurs lors de la saisie d'informations incorrectes

# [v.13.2.00] - 2021-10-18

* Added :
  * [#6] Contrôler horaire fin > horaire début lors de l'enregistrement ou la modification des heures d'ouvertures sur la fiche d'un tier
  * [#13] Si pas ouvert le lundi, permettre de Cloner sur les autres jours
  * [#15] Ajout de l'affichage des headers sur la fiche d'un tier, ticket, intervention lorsqu'on est sur l'onglet horaire d'ouvertures
  * [#14] Supression des valeurs d'une ligne en cliquant sur l'icône de poubelle sur le tableau des horaires d'ouvertures
  
* Fixed :
  * [#7] L'affichage du bouton modifier et le bouton enregistrer du tableau des horaires n'apparaît plus sur la fiche d'un ticket et d'une intervention
  * [#7] Retirer les droits du module
  * [#16] Renommer le module et sa description 
  
# [v13.0.00] - 2021-09-22

> Version initiale

* Added :
    * [#1] Création de l'onglet Horaires d'ouvertures dans la fiche d'un tier, d'un ticket et d'une intervention
