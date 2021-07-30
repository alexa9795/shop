# shop

Requirement for this projects can be found in practic.php.txt

- edit DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name" from .env file to configure database; set db_user to root, db_password to admin1234, db_name to valantic and serverVersion=5.7;

- insert data (from xml files, under public folder) using command php bin/console import-categories and php bin/console import-products (this will also populate productCategory and price tables)

- access http://localhost:8000/ to see
  1. List all categories name and all assigned active products numbers and names to the respective category in descending order. The relation between a category and a product should be active also.
  2. Visible products that have category "Dinghy und Jolle" and price bigger than 200.

