# Filament-Signes
Migration de signes de backpack à filament

Signes : 
Signes est une application web pour gérer les ESSMS (Établissements et Services 
Sociaux et 
Médico-Sociaux ) et permet surtout de suivre es signalements liés à des incidents se 
produisant 
dans ses établissements. 
Nous avons un total de 12 entités : 
- Utilisateurs
- Rôles
- Signalements
- Actions Signalements : Question sur un signalement 
- Etablissements : ESSMS 
- Catégories : Catégories d’établissements
- Secteurs : Secteurs d’établissements
- Options : Réponses pour les formulaires de signalements et d’action 
signalement
- Rubriques : Rubriques d’options 
- Sections : Sections d’options
- Faq : Question d’aide en ligne 
- CatFaq : Catégories de questions d’aides en ligne
-
Voici le schéma relationnel de la base de données 
Voici les cas d’utilisations : 
Page 10 sur 24
Page 11 sur 24
Mameri Heddy Conseil départemental Val d’Oise 2025 Rapport de stage
Figure 5: Cas d'utilisation
Au niveau des fonctionnalités de Signes nous avons : 
- Administration de toutes les entités sauf communes, rubriques et sections
- Exportation des logs 
- Exportation xlsx
- Widgets statistiques sur les signalements 
- Authentification 
Particularités : 
Le formulaire de signalement doit être dynamique. Il doit s’adapter aux réponses de 
l’utilisateur
