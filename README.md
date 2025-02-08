# DebateVerse

Une application web de débats développée avec Laravel permettant aux utilisateurs de créer et participer à des discussions structurées.

## 📋 Description

Cette plateforme offre un espace de débat organisé où les utilisateurs peuvent échanger des idées, voter sur différents sujets et communiquer en privé. L'application met l'accent sur la qualité des échanges et la sécurité des utilisateurs.

## ✨ Fonctionnalités

### Système d'Authentification
- Inscription sécurisée des utilisateurs
- Connexion avec authentification robuste
- Hachage sécurisé des mots de passe
- Gestion des profils utilisateurs

### Gestion des Débats
- Création de nouveaux sujets de débat
- Système de vote pour prendre position
- Interface intuitive pour suivre les discussions
- Catégorisation des débats par thèmes

### Système de Commentaires
- Ajout de commentaires sur les débats
- Discussions structurées et organisées
- Notifications pour les réponses
- Modération des contenus

### Messagerie Privée
- Conversations privées entre utilisateurs
- Interface de chat en temps réel
- Historique des conversations
- Notifications de nouveaux messages

## 🛠 Technologies Utilisées

- **Backend:** Laravel 8.x
- **Frontend:** 
  - JavaScript
  - Blade Template Engine
  - Bootstrap 5
- **Base de données:** MySQL
- **Conception:** UML

## 📦 Prérequis

- PHP >= 7.3
- Composer
- Node.js & NPM
- MySQL
- Git

## 🚀 Installation

1. Cloner le repository
```bash
git clone https://github.com/Mohamed072005/DebateVerse.git 
cd DebateVerse
```

2. Installer les dépendances PHP
```bash
composer install
```

3. Installer les dépendances JavaScript
```bash
npm install && npm run dev
```

4. Configurer l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurer la base de données dans le fichier .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_votre_base
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

6. Migrer la base de données
```bash
php artisan migrate
```

7. Lancer le serveur de développement
```bash
php artisan serve
```

## 📅 Calendrier du Projet

- **Début:** Février 2024
- **Fin prévue:** Mai 2024

## 🔒 Sécurité

- Hachage sécurisé des mots de passe
- Protection CSRF
- Authentification sécurisée
- Validation des données utilisateur
- Protection contre les injections SQL

## 🤝 Contribution

Les contributions sont les bienvenues ! Pour contribuer :

1. Forkez le projet
2. Créez votre branche (`git checkout -b feature/AmazingFeature`)
3. Committez vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Pushez vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrez une Pull Request
