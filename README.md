**

## Site web ADECIO

**
**Site construit dans le cadre de mon stage lors de ma formation Concepteur Développeur d'Applications (CDA) au GRETA de Montpellier (2020 - 2021)**

## **Le contexte**

Adecio est une petite structure qui propose du coaching et de la formation pour les entreprises. Ce site fait partie de la campagne de lancement prévue à partir de mi mai 2021.
Karine la responsable d'Adecio à travailler avec une Graphiste rédactrice (Frédérique Jarnot [fredjarnot.fr](fredjarnot.fr) afin de faire la maquette et le contenu.
De mon coté je suis partie de la maquette proposé sur Photoshop. Cette maquette était composé de quatre pages.
 - Une page d'accueil
 - Une page type permettant d'être utilisée sur les  pages du site avec
   un texte différent
 - Une page formation utilisée pour l'ensemble des formations avec texte
   et photo différents
 - Une  page Adecio qui parle d'Adecio et de la coach.

La difficulté du site -> Je devais permettre a Karine de pouvoir modifier les textes et les images de chaque page du site.

## **La technique**

Le site est fait en PHP en utilisant le framework **CodeIgniter 4** avec **TWIG**.
Coté client il utilise **Bootstrap en SASS et JQuery** et un plugin Javascript **CKEditor** pour la modification des textes.
Une base de données MySql.
Le site est hébergé chez OVH.
J'ai utilisé NetBeans v12 pour l'écriture du code

**Les éléments de la base de données**
Le MCD
![enter image description here](https://github.com/Michel-Cavaud/Adecio/blob/master/dossierConception/MCD%20SQL.png)
Le MLD
![enter image description here](https://github.com/Michel-Cavaud/Adecio/blob/master/dossierConception/MLD%20SQL.png)
[Le script](https://github.com/Michel-Cavaud/Adecio/blob/master/dossierConception/adecio.sql) 
Cette base de données utilise des vues pour avoir accès aux information des textes et photos en user ou en admin avec des requêtes SQL ([Les requêtes](https://github.com/Michel-Cavaud/Adecio/blob/master/dossierConception/requetes%20vues.sql))

**La modification des textes et des photos sur les page du site.**
Pour cela j'ai créé un site que j'appellerais **"admin"** il est à l'identique du site grand public mais donne la possibilité de modifier les textes et les images avec un menu supplémentaire. cette partie n'a pas d'accès direct du site grand public mais l'administrateur à un lien spécifique. Une connexion par identifiant et mot de passe lui sera demandée.

Une fois connecté l'administrateur voit le même site avec un menu sur le coté ![enter image description here](https://github.com/Michel-Cavaud/Adecio/blob/master/dossierConception/menu%20admin.png) et la possibilité par un click sur un paragraphe d'avoir l'ouverture d'une modale avec le texte du site et les éléments pour modifier le texte (avec CKEditor).

![enter image description here](https://github.com/Michel-Cavaud/Adecio/blob/master/dossierConception/modification%20texte.png)

Idem pour les images.
![enter image description here](https://github.com/Michel-Cavaud/Adecio/blob/master/dossierConception/modification%20image.png)

Dans CK Editor j'ai intégré les éléments graphiques du site (couleur, polices, taille des caractères)
L'admin peut demander la mise en place de cadre pour chaque paragraphes et images lui permettant d'avoir accès au éléments vides.
![enter image description here](https://github.com/Michel-Cavaud/Adecio/blob/master/dossierConception/cadre%20admin.png)

Une fois les éléments de la page en place l'admin doit enregistrer sa page pour changer les éléments de la page grand public.
![enter image description here](https://github.com/Michel-Cavaud/Adecio/blob/master/dossierConception/eng%20page.png)

L'admin peut aussi mettre a jour sont mot de passe.
![enter image description here](https://github.com/Michel-Cavaud/Adecio/blob/master/dossierConception/maj%20mdp.png)

Et se déconnecter.
![enter image description here](https://github.com/Michel-Cavaud/Adecio/blob/master/dossierConception/menu%20admin%20d%C3%A9connexion.png)
