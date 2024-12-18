# Chef’s Culinary Experience - Application Web

## Contexte du projet

Ce projet consiste à développer un site web pour un chef cuisinier mondialement reconnu, offrant une expérience gastronomique unique. Les utilisateurs peuvent découvrir des menus exclusifs, réserver des expériences culinaires à domicile et interagir avec le chef.

## Objectifs du Projet

### Site Web Multi-Rôles :
- **Utilisateurs (Clients)** :  
  - Découvrir les menus proposés par le chef.  
  - S'inscrire, se connecter et réserver une expérience culinaire.

- **Chefs (Administrateurs)** :  
  - Gérer les réservations (accepter, refuser, consulter les statistiques des demandes et gérer leur profil).

### Fonctionnalités Principales Implémentées :
- **Inscription et Connexion des Utilisateurs et Chefs** :  
  Les utilisateurs et les chefs peuvent s’inscrire et se connecter. Après une authentification réussie, ils sont redirigés vers des pages spécifiques en fonction de leur rôle.

- **Page Utilisateur (Client)** :  
  - Visualiser les menus du chef et réserver une expérience culinaire (en sélectionnant la date, l'heure et le nombre de personnes).  
  - Gérer les réservations : consulter l’historique, modifier ou annuler des réservations.

- **Page Chef (Dashboard)** :  
  - Gérer les réservations : accepter ou refuser les demandes en fonction de la disponibilité.  
  - Afficher des statistiques détaillées pour le chef :  
    - Nombre de demandes en attente.  
    - Nombre de demandes approuvées pour la journée.  
    - Nombre de demandes approuvées pour le jour suivant.  
    - Détails de la prochaine réservation et du client.  
    - Nombre de clients inscrits.

## Design du Site

- **Design Responsive** :  
  Le site est compatible avec les appareils mobiles, tablettes et ordinateurs de bureau.

- **Esthétique** :  
  Design moderne, élégant et raffiné pour refléter le luxe.

- **UX/UI** :  
  Interface intuitive et conviviale pour une navigation fluide.

## Fonctionnalités JavaScript Implémentées

- **Validation des Formulaires avec Regex** :  
  Utilisation des expressions régulières pour valider les saisies des utilisateurs dans les formulaires (email, numéro de téléphone, mot de passe, etc.).

- **Formulaires Dynamiques d'Ajout de Menus** :  
  Permet aux chefs d’ajouter dynamiquement plusieurs plats à un menu. Les champs de saisie peuvent être ajoutés ou supprimés sans recharger la page.

- **Modals** :  
  Utilisation de modals pour afficher des informations (détails de réservation, confirmations d'actions, messages d’erreur) sans recharger la page.

- **SweetAlerts** :  
  Intégration de SweetAlert pour des alertes visuelles élégantes lors d’actions clés (confirmation de réservation, annulation, etc.).

## Sécurité des Données

- **Hashage des Mots de Passe** :  
  Techniques sécurisées pour le hashage des mots de passe afin de protéger les identifiants des utilisateurs.

- **Protection contre XSS (Cross-Site Scripting)** :  
  Les entrées sont nettoyées et validées côté serveur pour prévenir les attaques XSS (en utilisant des outils comme HTMLPurifier).

- **Prévention des Injections SQL** :  
  Utilisation de requêtes préparées pour interagir avec la base de données et prévenir les attaques par injection SQL.

## Travail Réalisé

### Diagrammes Créés :
- **Diagramme ERD (Entity Relationship Diagram)** :  
  Le diagramme ERD a été créé pour illustrer la structure de la base de données et les relations entre les différentes entités du système.

- **Diagramme UML (Use Case Diagram)** :  
  Le diagramme UML de cas d'utilisation a été créé pour décrire les fonctionnalités du système et la manière dont les différents utilisateurs (clients et chefs) interagissent avec celui-ci.

### Développement Frontend :
- La partie frontend du site est entièrement implémentée, avec :
  - Un design responsive adapté aux appareils mobiles, tablettes et ordinateurs.
  - Une interface moderne, élégante et conviviale.
  - Des formulaires fonctionnels pour l’inscription et la connexion des utilisateurs et des chefs, ainsi que pour la gestion des réservations.
  - L’ajout dynamique de plats pour les chefs grâce à des composants d'interface en JavaScript.
  - Intégration de SweetAlert pour les actions importantes (confirmation de réservation, annulation, etc.).

## Prochaines Étapes
- Développement du backend et intégration avec le frontend.
- Mise en place de la gestion des réservations pour les chefs.
- Traitement des données, validation et mise en œuvre de mesures de sécurité supplémentaires.


Link de diagramme (UML): https://lucid.app/lucidchart/39d6b903-ae2d-473c-9436-604a5a09787e/edit?viewport_loc=1984%2C-995%2C6241%2C2716%2C0_0&invitationId=inv_90215a79-c216-4b4b-852b-f4d3a51d0329