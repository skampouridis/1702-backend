dimitriosDesyllas
=================

A simple API for retrieving ship routes.

#Installation

##Generating Database and tables

1. Create the `./var/db` folder with `777` UNIX permissions.
2. Run `php bin/console doctrine:database:create` to create the database.
3. Run `php bin/console doctrine:schema:create` to create the schema.
4. Run `php bin/console data:insert:csv ../ship_positions.csv` to import the data.

