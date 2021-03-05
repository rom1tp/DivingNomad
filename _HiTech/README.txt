L'application va être réalisée en architecture MVC

**1- BDD**

**2-L'url index.php?page=admin** doit nous conduire sur le formulaire de connexion au backoffice

**DANS LE DETAIL:**
- créer l'ensemble des fichiers et dossiers
- créer le fichier admin.phtml dans les views, y mettre le formulaire HTML
- créer le layout.phtml avec le code commun à toutes les pages du backoffice
- crér le controller AdminController.php, qui contient 1 méthod display. Cette méthode détermine le template et inclut le layout
- remplir l'index.php avec ce qu'il faut :-)

**3- trouver le moyen de ne pas avoir à faire tous les require en début de index.php**

**4-Gérer la connexion de l'utilisateur :**
- si l'utilisateur saisi le bon identifiant et mot de passe, il arrive sur le backoffice.
- s'il fait une erreur, un message s'affiche sous le formulaire
- ATTENTION s'il ne saisit pas les identifiants et mots de passe, il ne doit pas pouvoir accéder au backoffice

**DANS LE DETAIL**
- dans AdminController, créer une nouvelle method : "connect"
- cette méthode fait pour le moment un var_dump de $_POST pour voir si la soumission du formulaire fonctionne bien
- dans Admin.phtml, dans "action" du formulaire mettre la bonne url (mais laquelle ?? :-) indice...page=.....
- dans index.php, rajouter un case au switch avec cette nouvelle action possible
ce case instantie l'adminController et lance la méthode connect
- tenter alorsd de soumettre le formulaire juste pour voir si le var_dump fonctionne

**Une fois que ça fonctionne**

Dans le controller / connect: 
- récupérer les infos du formulaire
- aller chercher en base de données les infos concernant l'utilisateur qui essaie de se connecter
- si vous n'avez pas de résultat, c'est que l'email n'existe pas, mettez un message d'erreur en conséquence dans une propriété $error
- sinon, trouvez le moyen de comparer le mot de passe qui arriev de la bdd avec celui du formulaire
- si ça n'est pas bon, mettre un message dans $error
- sinon, créer la session, mettez dashboard.phtml dans la variable template et incluez le layout

**A vous de chercher : **
-->dans le cas des messages d'erreurs, il faudra recharger le template du formulaire et afficher le message sous le formulaire en rouge !

**5. la déconnexion**
Faire un lien depuis le dashboard "deconnexion", ce lien doit déconnecter l'administrateur et le rediriger vers le formulaire de connexion.
Comment allez vous faire ? Si une session atteste de la connexion de l'admin alors peut être faut il la détruire cette session ?

Le tout doit être fait en MVC:
- le lien mène vers index.php?page=deconnexion
- le controller AdminController va avoir alors une nouvelle méthode
- 
**6. Mettre ne place la réécriture d'urls**

**7. On clique sur gestion des produits** ça affiche le tableau avec la liste des articles

**DANS LE DETAIL mais pas trop :-)**
Un nouveau controller (parceque une nouvelle page)
Un nouveau template
Un nouveau model (produits)

Le controller demande la liste des produits au model puis il les transmets au template
Des conditions sur le statut des produits va vous permettre de gérer les couleurs (rouge vert...)

**8. Vérifier la sécurité de toutes les pages du backoffice**
Les pages ne doivent pas être accessibles si la session de connexion n'existe pas
Les controllers, dans leur construct vont donc vérifier l'existence de la session et rediriger vers le form de connexion si la session n'existe pas.
Pour la redirection, faire une recherche sur header()

**9. Gestion des boutiques**
9.1 : on clique sur le lien, la liste des boutiques apparaît (sous forme de tableau avec comme actions : supprimer / modifier)
9.2 : sur cette même page, un bouton "Ajouter une boutique" ouvre un formulaire d'ajout de boutique avec juste un champ texte
9.3 : A la soumission de ce formulaire, une boutique est ajoutée à la base de données et on est redirigé sur la liste des rubriques

**DANS LE DETAIL mais beaucoup moins**
- pour l'étape 9, 2 controllers : 1 pour l'affichage de la liste et 1 pour la gestion du form
- pour les models, je vous laisse réfléchir (1 model = 1 table)


**10. Gestion des rayons**
10.1 : on clique sur le lien, la liste des rayons apparaît (sous forme de tableau avec comme actions : supprimer / modifier)
10.2 : sur cette même page, un bouton "Ajouter un rayon" ouvre un formulaire d'ajout de rayon avec un champ texte et une liste déroulante (qui va chercher la liste des boutiques)
10.3 : A la soumission de ce formulaire, un rayon est ajouté à la base de données

**DANS LE DETAIL: là vous devriez faire sans explications...**
lien - index - controller - model..... tout doit être clair à présent :-)

**11. Ajouter un produit**
- rajouter le bouton au dessus du tableau des produits
- ce bouton mène vers le long, très long formulaire d'ajout...
- la particularité ici est l'upload des images:
    - trouver le type de l'input à mettre pour l'upload des fichiers
    - votre balise form doit prendre un nouvel attribut pour permettre l'upload, à vous de le trouver
    - le controller qui se lance suite à la soumission du form a beaucoup de travail:
        - insérer en bdd le nouveau produit (attention pour les images, il faut mettre le src)
        - uploader toutes les images (https://www.php.net/manual/fr/function.move-uploaded-file.php)
**ATTENTION**
Lorsque la boutique est choisie, la liste des rayons doit se mettre en jour (à faire en JS).
        
**12. Supprimer une boutique **
- un clic sur un bouton supprimer à côté d'une boutique va ouvrir un popup pour demander à l'utilisateur s'il est sûr.
- si il répond non, le popup se ferme
- si il répond oui, la suppression est effective
ATTENTION ICI JS

**13. Supprimer un rayon **
Idem que pour boutique

**14. Modification d'une boutique**
- Au clic sur modifier à côté d'une boutique, le formulaire d'ajout s'affiche mais préremplir
- A la validation du formulaire , un update de la boutique est fait.

**15. Modification d'un rayon**
-Idem


**FRONT**

**La page article **
L'url article-4 affichera la page de l'article n°4 côté front.
Il va falloir ensuite générer cette page. Le controller doit aller chercher toutes les informations présentes sur cette pag ET celles communes à toutes les pages (menu)

- un controller mère qui gère les infos présentes sur toutes les pages
- un autre qui en hérite et va chercher les infos de cette page

Côté model, ajouter les requêtes nécessaires mais n'hésitez pas à réutiliser des requêtes déjà faites pour le back, on a l droit !!!!

Le carrousel photo est à gérer en JS

AA


