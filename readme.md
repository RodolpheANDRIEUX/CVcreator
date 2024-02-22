# CVcreator

Un créateur de CV en ligne.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- PHP
- SQL
- Composer
- wkhtmltopdf (cf 'Installation')

## Installation

Après avoir cloné le projet, vous devez installer les dépendances. Voici comment vous pouvez le faire :

1. **wkhtmltopdf**

   Ce projet utilise wkhtmltopdf pour générer des PDF à partir de HTML. Assurez-vous de l'avoir installé sur votre machine. Vous pouvez le télécharger depuis le site officiel : https://wkhtmltopdf.org/downloads.html. Après l'installation, ajoutez le chemin d'accès à wkhtmltopdf dans votre variable d'environnement PATH.


2. Naviguez vers le répertoire du projet cloné. Par exemple, si vous avez cloné le projet dans un répertoire appelé `projects` sur votre bureau, vous pouvez y accéder avec la commande suivante :

```bash
cd ~/Desktop/projects/CVcreator
```

3. Une fois dans le répertoire du projet, installez les dépendances avec la commande suivante :

```bash
composer install
```
Cela installera toutes les dépendances nécessaires pour le projet.


## Configuration

1. **Base de données**

   Wkhtmltopdf etant suffisament contraignant (more about that later), nous avons choisi de scripter la creation de base de données. Vous n'avez donc pas besoin de creer une base de données vous même.
Cependant, vous devez configurer les informations de connexion à la base de données:<br><br>
Dans un contexte réel, vous devriez créer un fichier `.env` à partir du fichier `.env.example` et y ajouter les informations de connexion à la base de données.
Dans un contexte de développement, vous pouvez simplement modifier le fichier `db_config.php` et y ajouter les informations de connexion à la base de données ainsi que le chemin d'accés à wkhtmltopdf.
```
CVcreator/src/data/db_config.php
```
> 💡  Vous pouvez probablement tout laisser par default...

## Utilisation

1. **Serveur local**

   Pour lancer le serveur le plus simple est d'utiliser Laragon. Une fois lancer vous pouvez accéder à l'application en tapant l'adresse suivante dans votre navigateur :

   ```
    http://localhost/CVcreator/
    ```
    Vous devriez voir la page d'accueil de l'application. (si ce n'est pas le cas bonne chance avec ca...)<br><br>

2. **Création de CV**

   Pour créer un CV, vous devez d'abord vous inscrire mais tout est guidé.
> 💡  Vous pouvez aussi vous connecter avec les identifiants suivants :<br> Username: `admin`<br> Password: `12341234`<br> (mais c'est moins marrant...)

## Démarche de développement

1. **Frontend**

   - **HTML/CSS** : J'ai utilisé HTML et CSS pour la structure et le style de l'application. J'ai choisit un style moderne mais je n'ai pas eu le temps de la travailler rigouresement car ca n'etait pas évalué.
   - **JavaScript** : J'ai utilisé le minimum possible de JavaScript. Il n'y a que une ou deux fonctions servant pour le dom. Le but etait d'utiliser php le plus possible.
   
2. **Backend**

    - **PHP** : J'ai utilisé uniquement PHP sans aucun framework pour la logique de l'application. Le but etait de s'exercer un maximum avec le langage brut. Pour une web app en situation réel j'aurais utilisé un framework comme Laravel. (J'aurais surtout utilisé autre chose que php mais bon...)
    - **Database** : J'ai utilisé un script pour générer et seed la base de données. La seed sert à ajouter tout les type de permis disponible, les couleurs et un user `admin` afin de pouvoir tester l'application sans avoir à s'enregistrer à chaque fois.
    - **wkhtmltopdf** : J'ai utilisé wkhtmltopdf pour générer des PDF à partir de HTML mais je regrette encore. La consigne demandait d'utiliser un outil natif de php. J'ai donc utilisé tcpdf pour générer les pdf. Je me suis alors apercu que pratiquement tout le css des models n'etait pas supporté. J'ai donc utiliser dompdf qui est plus complet mais qui en plus de ne pas avoir tout le css avait des problemes avec les images. J'ai donc pris la d'installer wkhtmltopdf. Ca n'est peutetre pas natif au PHP mais le script pour generer les PDF est en PHP. Malheuresement son utilisation s'est averé plus difficile que prevu et je n'ai toujours pas 100% du CSS qui passe... Je n'allait pas essayer tout les outils de generation de PDF du web donc j'ai laissé tomber. Si j'avais eu à le refaire j'aurais utilisé puppeteer pour générer les PDF. 
    - **Sécurité** : J'ai évidement utilisé un model MVC qui participe à la sécurité. J'aurais aimé avoir le temps d'ecrire la validation de tout les formulaires dans les `controlers` mais vu la taille du projet je n'ai pas trouvé ca pertinent. La sécurité n'est donc clairement pas sans faille mais il ne manquerai pas grand chose pour la rendre acceptable.
    - **Tests** : j'ai découvert avec effroi que php n'avais pas de terminal dans lequel on pouvait debugger et lire les erreurs. J'ai donc creer un classe Logger pour mettre des logs un peu partout dans le code. Ainsi j'ai pu faire du test live en regardant les logs. Les test en TDD n'etant pas demandé je n'ai pas jugé utile de les faire.
    - **Models** : J'ai créé tres peu de models de CV. Le but etait simplement de montrer qu'il etait possible de le faire mais etant donné le resultat médiocre sur la version PDF j'ai preferer ne pas perdre mon temps à faire des jolis petits CV.<br><br>

3. **Améliorations**

   - **Sécurité** : J'aurais aimé avoir le temps d'ecrire la validation de tout les formulaires dans les `controlers` comme énoncé plus haut.
   - **PDF** : J'aurais aimé pouvoir utiliser puppeteer pour générer les PDF.
   - **structure** : J'aurais voulu séparer le fichier `actions.php` en plusieurs fichiers pour plus de clarté. J'aurais meme pu utiliser ici aussi la poo pour plus de coherence.
   - **CSS** : J'aurais aimé avoir le temps de rendre le site responsive et de travailler le style. Cependant, hormis sur des formats mobiles, le site devrait etre responsive.
   - **partage** Actuellement le lien de partage fonctione avec un ID de CV. J'aurais du modifier ma db pour y mettre une table de clé de partage. Ainsi une clé aléaroire aurait été généré pour chaque CV partagé. Ca aurait été plus sécurisé car actuellement n'importe qui peut lire tout les CV en mettant l'ID dans le lien.<br><br>
   
## Conclusion

J'ai pris pas mal de plaisir à réaliser ce projet. J'ai appris des choses et j'ai pu mettre en pratique mes connaissances. J'aurais aimé avoir le temps de travailler le style et la structure du code mais je suis tout de meme satisfait du resultat. J'espere que vous le serez aussi. Merci de m'avoir lu.

## Auteur

**[ANDRIEUX Rodolphe](https://github.com/RodolpheANDRIEUX)**