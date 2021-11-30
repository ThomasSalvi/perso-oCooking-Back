# oCooking

Le projet oCooking est une application permettant de consulter et de partager des recettes de cuisine.

## Organisation du projet

Nous allons suivre la méthodologie Agile Scrum.

Le Product Owner a déjà fait tout le travail de préparation et nous a mis à disposition [le product backlog sur Trello]().

## Choix techniques

### Frontend

Le front-end sera développé à l'aide du framework Vue.js. Tout le front-end sera imaginé et développé dans un repository GitHub à part.

### Backend

WordPress est la solution qui a été sélectionnée pour la partie backend du projet :

- Le backoffice permettra aux administrateurs et rédacteurs du site de gérer les différents contenus.
- Une API REST devra être mise à disposition à l'application front-end, ce que WordPress peut générer très "rapidement".

#### Base de données

Le modèle conceptuel de données n'a pas encore été imaginé. Il faudra s'en charger avant de commencer à développer. Tous les documents de conception liés à la base de données seront à mettre dans le dossier `conception`.
