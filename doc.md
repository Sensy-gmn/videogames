# VIDEOGAMES

## Créer une db

### Tables

- role      : id, name
- user      : id, username, password, role_id
- library   : id, user_id, game_id
- game      : id, title, released_year, jacket NULLABLE, category_id, plateform_id
- category  : id, name
- plateform : id, name

Si un utilisateur supprime son compte, on supprime automatiquement tous ces jeux.

=> Créer une entité et un manager pour chaque table.

### Accès

- On doit pouvoir créer un compte et se connecter

- Un utilisateur peut ajouter/modifier/supprimer un jeu dans sa bibliothèque

- Seul un admin peut ajouter/modifier/supprimer une catégorie ou une plateforme ou un jeu

### Dans chaque entité, on ait une ou plusieurs methodes qui permettent de retrouver les elements qui lui sont liés en DB.