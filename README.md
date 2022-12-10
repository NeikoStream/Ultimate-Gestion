# Ultimate-Gestion

## Sujet : Gestion d'une équipe de sport

Votre équipe favorite a besoin de vous !

L'entraîneur vous demande de réaliser une application qui l'aidera à faire les sélections des joueurs pour les matchs.

Il souhaite pouvoir administrer la liste de ses joueurs (avec leurs noms et prénoms, une photo, leur numéro de licence, leur date de naissance, leur taille et leur poids, et leur poste préféré dans l'équipe) ainsi que celle des matchs (avec la date et l'heure, le nom de l'équipe adverse, le lieu de rencontre - domicile ou extérieur -, et le résultat qui sera saisi une fois le match terminé).

Il souhaite également pouvoir ajouter des notes personnelles (commentaires) sur chaque joueur et préciser leur statut : Actif, Blessé, Suspendu, ou Absent.

Avant chaque match il veut pouvoir choisir la liste des joueurs qui participeront, en précisant qui sera titulaire et qui sera remplaçant. Il ne faudra lui proposer que les joueurs actifs.

Après chaque match, il souhaite pouvoir évaluer la performance de chaque joueur ayant participé au match ; l'évaluation peut être mise en oeuvre par un système de notation (de 1 à 5 par exemple) ou un système d'étoiles par exemple.

Enfin, il souhaite avoir des statistiques qui l'aideront dans sa prise de décision.

 

Ce projet doit être réalisé en binôme.

Vous pouvez choisir le sport d'équipe de votre choix (Football, Rugby, Basketball, Volleyball, etc.), vous ferez les adaptations nécessaires à chaque sport (nombre de titulaires par match par exemple).

Avant de vous lancer dans le développement prenez le temps de bien réfléchir à votre application dans sa globalité. N'hésitez pas à faire des maquettes des différents écrans et posez-vous des questions d'ordre pratique (par exemple, est-ce qu'il ne serait pas intéressant de mémoriser le statut d'un match pour savoir s'il a déjà été préparé ou pas ?).

Gardez à l'esprit que l'application devra être pratique à utiliser et accessible à des néophytes. Imaginez ce que ça ferait si vous deviez l'utiliser tous les jours !


### Upload de la photo du joueur

Pour uploader la photo des joueurs vous devez suivre les instructions suivantes :

1/ créer un dossier, par exemple "projet-photos" en dehors du dossier www (voir les notions de sécurité du cours) ;

2/ ajouter le droit d'écriture à ce nouveau dossier pour les autres ;

3/ uploader vos photos dans ce nouveau dossier.

Les photos ainsi téléchargées appartiennent à l'utilisateur www-data, celui utilisé pour exécuter apache.

### Modèle de données

Sur papier ou à l'aide de l'outil de votre choix, réaliser le modèle de données pour cette application.

APRÈS L'AVOIR FAIT VALIDER par votre enseignant, créer la base de données MySQL correspondante.

 

### Gestion des joueurs et des matchs

Créer les pages nécessaires à l'affichage, l'ajout, la modification, et la suppression des joueurs et des matchs.

 

### Saisie des feuilles de match

Créer une page permettant de faire une sélection parmi les joueurs actifs et de définir pour chaque joueur choisi s'il sera titulaire ou remplaçant. Si le nombre minimum de joueurs n'est pas atteint, la sélection ne devra pas pouvoir être validée. L'interface de sélection devra afficher les informations des joueurs : photo, taille, poids, poste préféré, commentaires et évaluations de l'entraineur.

Adapter l'affichage des matchs pour permettre de visualiser et modifier la sélection.

 

### Statistiques

Si ce n'est pas déjà fait, modifier la page de modification d'un match pour permettre la saisie du résultat ainsi que les évaluations de l'entraîneur.

Créer ensuite une page affichant les statistiques suivantes :

Le nombre total et le pourcentage de matchs gagnés, perdus, ou nuls.
Un tableau avec pour chaque joueur : son statut actuel, son poste préféré, le nombre total de sélections en tant que titulaire, le nombre total de sélections en tant que remplaçant, la moyenne des évaluations de l'entraîneur, et le pourcentage de matchs gagnés lorsqu'il a participé.
Si possible, ajouter également le nombre de sélections consécutives (facultatif).
 

### Cadre de l'application

Sécuriser l'application en créant une page d'authentification (à l'aide d'un nom d'utilisateur et d'un mot de passe définis à l'avance). Aucune autre page de l'application ne devra être accessible si l'utilisateur n'est pas authentifié.

Mettre en place un menu qui sera affiché sur chaque page pour permettre à l'utilisateur de naviguer dans l'application. Ajouter tous les liens nécessaires entre les différentes pages.

 

### Mise en forme

Utiliser les feuilles de style (CSS) et les bases d'ergonomie logicielle pour faire en sorte que l'utilisation de l'application soit la plus agréable et intuitive possible.

NB : La priorité reste le code et les fonctionnalités, attention à ne pas perdre trop de temps sur la forme.

## Notre choix

Nous avons choisi de travailler sur l'ultimate, un sport collectif utilisant un disque opposant deux équipes de sept joueurs.

## Langages

- PHP
- HTML & CSS
- PHPmyadmin
