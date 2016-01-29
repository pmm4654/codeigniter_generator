# codeigniter_generator
Codeigniter basic CRUD generator (include: controller, model, some view, migration) - WIP

THIS CURRENTLY WORKS WITH WIREDESIGNZ HMVC CODEIGNITER SETUP
-This works for codeigniter 3.0 now.  I think there may be naming issues with the migrations in earlier versions now (they begin with a timestamp now).  I can add a fix if anyone wants one.

Copy and paste the cli module into your 'Modules' folder and cd to your project's root
Use the command:
  php index.php cli generate
(add php to your path if you need to)

This will give you a series of questions to generate a Controller, Model and a form view and a table view of all records.  This will generate a migration, also, but it only works properly for creating a new table.  I plan to add more for updates, deleting, etc.

Doing the full generation of a Controller, Model and view(s) will create the corresponding files in the 'controllers', 'models', and 'views' folders in the name of the module(same name you gave your controller).  The migration will go into 'application/migrations'.  If you delete these folders in the 'cli' module, they won't be generated (an issue I plan on fixing).  If you generate a module that already exists, it should throw an error and it will not generate a new one.

All the code generation is in the controller in the 'cli' module
This is my first CLI generator, so I'm sure there are better ways to write the code.  If you have any ideas/suggestions, let me know!
