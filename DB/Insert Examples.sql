# Create a new User:
INSERT INTO users (first_name, last_name, email)
VALUES ('admin', 'admin', 'admin@admin.com');

# Create a new Recipe:
INSERT INTO recipes (title, Description, user_id)
VALUES ('Breakfast Cereal', 'Prepare a bowl of your favorite breakfast cereal.', 1);

# Add Instructions
INSERT INTO instructions (description, recipe_id)
VALUES ('Pour your favorite dry breakfast cereal into a clean bowl.', 1);
INSERT INTO instructions (description, recipe_id)
VALUES ('Pour your desired milk into the bowl of dry breakfast cereal.', 1);

# Add Ingredients
INSERT INTO ingredients (`ingredient`, `amount`, `unit`, `recipe_id`)
VALUES ('Favorite dry breakfast cereal', 1.0, 'cup', 1);
INSERT INTO ingredients (`ingredient`, `amount`, `unit`, `recipe_id`)
VALUES ('Desired milk', 1.0, 'cup', 1);

#
#
#

# Create a new Recipe:
INSERT INTO recipes (title, Description, user_id)
VALUES ('Dinner Cereal', 'Prepare a bowl of your dinner breakfast cereal.', 1);

# Add Instructions
INSERT INTO instructions (description, recipe_id)
VALUES ('Pour your favorite dry dinner cereal into a clean bowl.', 2);
INSERT INTO instructions (description, recipe_id)
VALUES ('Pour your desired milk into the bowl of dry dinner cereal.', 2);

# Add Ingredients
INSERT INTO ingredients (`ingredient`, `amount`, `unit`, `recipe_id`)
VALUES ('Favorite dry dinner cereal', 1.0, 'cup', 2);
INSERT INTO ingredients (`ingredient`, `amount`, `unit`, `recipe_id`)
VALUES ('Desired milk', 1.0, 'cup', 2);
