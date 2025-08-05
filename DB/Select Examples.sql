select * from users;

select * from recipes;

select * from instructions;

select * from ingredients;

select recipes.title, recipes.Description, users.first_name, users.last_name from recipes
INNER JOIN users ON recipes.user_id=users.id;