# TP2  WEB

## Utilisation du dépot

Quand on commence une fonctionnalité, on fork la branche dev, on travaille sur notre branche. Ensuite quand on a finit, on pull dev, on merge dev à notre branche, on résoud les conflits, on merge notre branche à dev, on push, on supprime notre branche.
Les versions stables (testées en profondeur) seront merge sur master de temps à autre.

## TO-DO
Note : avec tout ce qui est indiqué, il y a aura probablement des fonctions à ajouter dans les controllers, voir des controllers à faire.
Si on voit mieux comment découper les tâches au besoin faut pas hésiter à modifier.

### Page de connexion
Cette page permet d'entrer l'identifiant du compte, ou d'en crééer un.

* ~~Faire le champs de connexion~~ fait
* Faire un suivi de session sur tout le site
* Faire le champs de création de compte (même page ou nouvelle page ?)

### Page de choix
Cette page permet d'effectuer les opérations sur un compte

* Faire le menu (retrait, dépot)
* Afficher la somme restante sur le compte
* Bouton de déconnexion (=> retour page de co)

### Page de dépot / retrait
Cette page permet de gérer un dépot ou un retrait (ce qui est concrétement la même chose, juste un retrait de x dollars c'est la même chose que un dépot de -x dollars)

* Faire la page commune
* Ajouter les redirections dans la page de choix

### Style global

* Définir la gueule du site
* Style page de co
* Style page de choix
* Style page dépot/retrait
