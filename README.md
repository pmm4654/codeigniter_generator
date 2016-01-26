# codeigniter_generator
Codeigniter basic CRUD generator (include: controller, model, some view, migration) - WIP

THIS CURRENTLY WORKS WITH WIREDESIGNZ HMVC CODEIGNITER SETUP
-I plan on making it work with a standard setup with upgrades to Codeigniter 3.

Copy and paste this module into your 'Modules' folder and cd to your project's root
Use the command:
  php index.php cli generate
(add php to your path if you need to)

This will give you a series of questions to generate a Controller, Model and (as of now) a single view.  This will generate a migration, also, but it only works properly for creating a new table.  I plan to add more for updates, deleting, etc.

Doing the full generation of a Controller, Model and view(s) will create the corresponding files in the 'controllers', 'models', and 'views' folders in the 'cli' module.  The migration will go into 'application/migrations'.  If you delete these folders in the 'cli' module, they won't be generated (an issue I plan on fixing).

This is my first CLI generator, so I'm sure there are better ways to write the code.  If you have any ideas/suggestions, let me know!
