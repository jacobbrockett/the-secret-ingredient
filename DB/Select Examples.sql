select * from users;

select * from recipes;

select * from instructions;

select * from ingredients;

select recipes.title as 'Title', recipes.Description as 'Description', users.first_name as 'First_Name', users.last_name as 'Last_Name' from recipes
INNER JOIN users ON recipes.user_id=users.id;

select recipes.title as 'Title', recipes.Description as 'Description', users.first_name as 'First_Name', users.last_name as 'Last_Name'
from recipes INNER JOIN users ON recipes.user_id=users.id
where recipes.id=2;

select ingredients.amount as 'Amount', ingredients.unit as 'Unit', ingredients.ingredient as 'Ingredient' from ingredients where recipe_id=2;

select instructions.id as 'Id', instructions.description as 'Description' from instructions where recipe_id=1 order by instructions.id;

