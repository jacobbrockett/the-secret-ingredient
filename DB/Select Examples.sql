select * from users;

select * from recipes;

select * from instructions;

select * from ingredients;

select recipes.title as 'Title', recipes.Description as 'Description', users.first_name as 'First_Name', users.last_name as 'Last_Name' from recipes
INNER JOIN users ON recipes.user_id=users.id;