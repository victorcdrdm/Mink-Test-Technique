# Mink test technique 

## Getting Started

1. Run the project `docker compose build --no-cache`
2. the front will be on this url: `http://localhost:3000/`
3. Swagger will be on this url: `https://localhost/api/docs`
4. To access Admin Interface `https://localhost/login`
    email: `admin@mink.fr`
    password: `password` 

## Stack

1. Symfony 7 php 8
2. vueJs 3
3. Caddy/Frankenphp
4. PostgreySql

# Temps Passés par Tâche

## Back-end (Total : 12h30)
- **Authentification** : 2h
- **Authentification + création utilisateur** : 2h  
  *Difficulté avec l'API plateforme*
- **Création des entités et enums** : 1h
- **Création des contrôleurs pour les routes personnalisées** : 3h
- **Modification de l'authentification** : 1h
- **EasyAdmin** : 3h
- **Création de migration pour le lancement du projet** : 30mn

## Front-end (Total : 10h)
- **Installation de Tailwind** : 30mn
- **Modèles et enums TypeScript** : 1h30
- **Appels API et envois au front** : 5h 
  - *Mise en place d'Axios* : 30mn 
  - *Appels API pour les différentes routes* : 2h
  - *Renvois des données au front* : 2h30  
    *Problèmes de connaissance du framework front et retour des objets Axios*
- **Gestion de l'admin côté front** (IA Bolt) : 1h
- **Templating de la liste des animaux** (IA Bolt) : 1h
- **Fonction de filtrage** (IA) : 30mn
- **Ajout de la modal** : 1h

## Infra (Total : 5h)
- **Recherche + test en local** : 2h
- **Ajout de Node au docker-compose** : 3h

## Temps Total (4 jours) : 27h30

---

## Résumé et Retours d'Expérience
- **Back-end** : Aucune difficulté notable une fois que l'API Platform a été pris en main, permettant un développement rapide.
- **Front-end** : L'initialisation du projet a été chronophage. Après avoir obtenu un exemple généré par l'IA, j'ai pu avancer plus efficacement.
- **Erreurs de Projet** : La plus grosse dificulté a été de gérer la partie admin avec Vue. Garantir l'accès à des pages uniment aux utilisateurs connecter, plus la récupération du cookie de connexion pour les raquettes a l'api (problème que je n'avais pas eu avec Postman).
La décision de retravailler l'authentification et d'utiliser EasyAdmin ma fais gagner en temps de dévelopement précieux.
