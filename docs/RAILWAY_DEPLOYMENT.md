# Guide de déploiement Railway pour RiosApp

## Étapes pour déployer sur Railway

### 1. Préparer le repository
✅ Dockerfile créé et optimisé
✅ railway.toml configuré
✅ .htaccess existant
✅ Code optimisé pour la production

### 2. Déployer sur Railway

1. **Aller sur [railway.app](https://railway.app)**
2. **Se connecter avec GitHub**
3. **Cliquer sur "New Project"**
4. **Sélectionner "Deploy from GitHub repo"**
5. **Choisir le repository RiosApp**
6. **Railway détectera automatiquement le Dockerfile**

### 3. Configurer les variables d'environnement

Railway va automatiquement détecter votre base de données MySQL existante et créer les variables :
- `DB_HOST`
- `DB_PORT` 
- `DB_NAME`
- `DB_USER`
- `DB_PASSWORD`

**Vous devez juste ajouter manuellement :**
- `PUBG_API_KEY` = votre clé API PUBG

### 4. Variables d'environnement Railway

Dans Railway, allez dans Settings > Variables et ajoutez :

```
PUBG_API_KEY=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiI2NDEwYWM3MC0yMzViLTAxM2QtY2I2NS0wMmFjNjY4OTg4OGEiLCJpc3MiOiJnYW1lbG9ja2VyIiwiaWF0IjoxNzIwODg0OTAwLCJwdWIiOiJibHVlaG9sZSIsInRpdGxlIjoicHViZyIsImFwcCI6Ii02OGM5NTA1OC03ZWE2LTQ5MDUtOTdjNy0yYjJjZGU1NWJhM2UifQ.vGv_RZhbvn7ec6XpJZl2L4tdcfpekBQyehtThspayBI
```

### 5. Déploiement automatique

- Railway va automatiquement déployer à chaque push sur la branche main
- Le build prendra quelques minutes la première fois
- Vous obtiendrez une URL publique : `https://riosapp-production.up.railway.app`

### 6. Vérifications post-déploiement

1. ✅ App accessible via l'URL Railway
2. ✅ Connexion à la base de données MySQL
3. ✅ Inscription/connexion fonctionne  
4. ✅ Ajout de joueurs avec stats PUBG
5. ✅ Pas d'erreurs PHP affichées

### 7. Domaine personnalisé (optionnel)

Dans Railway Settings > Domains, vous pouvez :
- Utiliser un sous-domaine gratuit `*.up.railway.app`
- Connecter votre propre domaine

## Troubleshooting

### Si le déploiement échoue :
1. Vérifier les logs dans Railway
2. S'assurer que `composer.json` est valide
3. Vérifier que toutes les variables d'environnement sont définies

### Si l'app ne démarre pas :
1. Vérifier les logs Apache dans Railway
2. Tester localement avec Docker : `docker build -t riosapp . && docker run -p 8000:80 riosapp`

### Performance :
- Railway redémarre automatiquement l'app si elle crash
- Scaling automatique inclus
- CDN global pour les assets statiques

## Coût

- **Hobby Plan** : $5/mois
- Inclut : 
  - App web
  - Base de données MySQL existante
  - Domaine HTTPS
  - Déploiements illimités