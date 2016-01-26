<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cli extends MX_Controller 
{

	function __construct() 
	{
		parent::__construct();
	}
	
	function generate()
	{
		$this->load->helper('file');
		

		echo "What will you name your controller? \n";
		echo "Controller Name: ";
		$controller_name = trim(fgets(STDIN));

		$data = $this->return_create_controller($controller_name);

		if ( ! write_file("application/modules/cli/controllers/".$controller_name.".php", $data))
		{
		     echo 'Unable to write the file';
		}
		else
		{
		     echo 'File written! '."\n";
		}

		echo "Do you want to create a model, as well? (yes/no or y/n) \n";

		$user_input = trim(fgets(STDIN));
		$create_model = ( ($user_input == 'yes') || ($user_input == 'y') ) ? (TRUE) : (FALSE);
		
		if ($create_model) 
		{
			echo "\n Enter field names in a comma-separated list -- no spaces \n";
			echo "An 'id' field will be added as a primary, auto-incrementing key so do not add one.";
			echo "Ex: field1,field2  \n";
			echo "Fields: ";
			$db_fields_csv = trim(fgets(STDIN));
			$db_fields = explode(",", $db_fields_csv);

			$data = $this->return_create_model($controller_name, $db_fields);
			if ( ! write_file("application/modules/cli/models/mdl_".$controller_name.".php", $data))
			{
			     echo 'Unable to write the file';
			}
			else
			{
			     echo 'All done! '."\n";
			}
		} else
		{
			echo 'No model created. Ending generation.';
		}

		echo "Enter a descriptive name for migration (separated by underscores) \n";
		echo "Ex: add_users_table \n\n";
		echo "Migration Name: ";
		$migration_name = trim(fgets(STDIN));	

		$migration = $this->return_migration_string($migration_name, $controller_name, $db_fields);
		$next_migration_version = $this->next_migration();
		if ( ! write_file("application/migrations/".$next_migration_version."_".$migration_name.".php", $migration))
		{
		     echo 'Unable to write the migration file '."\n";
		}
		else
		{
		     echo 'File written! '."\n";
		}	

		echo "Generating form... \n";

		$form = $this->return_form_string($controller_name, $db_fields);
		if ( ! write_file("application/modules/cli/views/".$controller_name."_form.php", $form))
		{
		     echo 'Unable to write the file';
		}
		else
		{
		     echo 'File written! '."\n";
		}	
	}
	

	function message($to = 'World')
	{
		echo "Hello ".$to."!";
	}

	function return_create_controller($controller_name) 
	{
		$data = 
"<?php if (!defined('BASEPATH')) exit('No direct script access allowed');	

class ".ucfirst($controller_name)." extends MX_Controller
{
	function __construct() 
	{
		parent::__construct();
		\$this->load->model('mdl_".$controller_name."');
	}

	function create() 
	{
		\$data = \$this->get_data_from_post();
		\$data['form_location'] = '".$controller_name."/insert_record';
		\$this->load->view('".$controller_name."_form', \$data);
	}

	function edit() 
	{
		\$id = \$this->uri->segment(3);
		\$data = \$this->get_data_from_db(\$id);
		\$data['form_location'] = '".$controller_name."/update_record/'.\$id;
		\$this->load->view('".$controller_name."_form', \$data);
	}

	function insert_record()
	{
		\$data = \$this->get_data_from_post();
		\$this->_insert(\$data);
		\$id = \$this->get_max();
		redirect('".$controller_name."/edit/'.\$id);
	}

	function update_record()
	{
		\$id = \$this->uri->segment(3);
		\$data = \$this->get_data_from_post();
		\$this->_update(\$id, \$data);
		redirect('".$controller_name."/edit/'.\$id);
	}

	function get_data_from_db(\$id) 
	{
		\$data = \$this->mdl_".$controller_name."->get_data_from_db(\$id);
		return \$data;
	}

	function get_data_from_post() 
	{
		\$data = \$this->mdl_".$controller_name."->get_data_from_post();
		return \$data;
	}

	function get(\$order_by) 
	{
		\$query = \$this->mdl_".$controller_name."->get(\$order_by);
		return \$query;
	}
		
	function get_with_limit(\$limit, \$offset, \$order_by) 
	{
		\$query = \$this->mdl_".$controller_name."->get_with_limit(\$limit, \$offset, \$order_by);
		return \$query;
	}
		
	function get_where(\$id) 
	{
		\$query = \$this->mdl_".$controller_name."->get_where(\$id);
		return \$query;
	}
		
	function get_where_custom(\$col, \$value) 
	{
		\$query = \$this->mdl_".$controller_name."->get_where_custom(\$col, \$value);
		return \$query;
	}
		
	function _insert(\$data) 
	{
		\$this->mdl_".$controller_name."->_insert(\$data);
	}
		
	function _update(\$id, \$data) 
	{
		\$this->mdl_".$controller_name."->_update(\$id, \$data);
	}
		
	function _delete(\$id) 
	{
		\$this->mdl_".$controller_name."->_delete(\$id);
	}
		
	function count_where(\$column, \$value) 
	{
		\$count = \$this->mdl_".$controller_name."->count_where(\$column, \$value);
		return \$count;
	}
		
	function get_max() 
	{
		\$max_id = \$this->mdl_".$controller_name."->get_max();
		return \$max_id;
	}
		
	function _custom_query(\$mysql_query) 
	{
		\$query = \$this->mdl_".$controller_name."->_custom_query(\$mysql_query);
		return \$query;
	}
}";
		return $data;
	}

	function return_create_model($model_name, $db_fields_array)
	{
		$db_fields = ($db_fields_array) ? ($db_fields_array) : ('');
		$data = 
"<?php if (!defined('BASEPATH')) exit('No direct script access allowed');	

class Mdl_".$model_name." extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
	}

	function get_table() 
	{
		\$table = '".$model_name."';
		return \$table;
	}
	
	function get_data_from_post() 
	{
".$data_from_post = $this->repeat_for_each_field($db_fields, 'post')."
		return \$data;
	}

	function get_data_from_db(\$id) 
	{
		\$query = \$this->get_where(\$id);
		foreach (\$query->result() as \$row)
		{
".$data_from_db = $this->repeat_for_each_field($db_fields, 'db')."
		}
		return \$data;
	}

	function get(\$order_by) 
	{
		\$table = \$this->get_table();
		\$this->db->order_by(\$order_by);
		\$query=\$this->db->get(\$table);
		return \$query;
	}
		
	function get_with_limit(\$limit, \$offset, \$order_by) 
	{
		\$table = \$this->get_table();
		\$this->db->limit(\$limit, \$offset);
		\$this->db->order_by(\$order_by);
		\$query=\$this->db->get(\$table);
		return \$query;
	}
		
	function get_where(\$id) 
	{
		\$table = \$this->get_table();
		\$this->db->where('id', \$id);
		\$query=\$this->db->get(\$table);
		return \$query;
	}
		
	function get_where_custom(\$col, \$value) 
	{
		\$table = \$this->get_table();
		\$this->db->where(\$col, \$value);
		\$query=\$this->db->get(\$table);
		return \$query;
	}
		
	function _insert(\$data) 
	{
		\$table = \$this->get_table();
		\$this->db->insert(\$table, \$data);
	}
		
	function _update(\$id, \$data) 
	{
		\$table = \$this->get_table();
		\$this->db->where('id', \$id);
		\$this->db->update(\$table, \$data);
	}
		
	function _delete(\$id) 
	{
		\$table = \$this->get_table();
		\$this->db->where('id', \$id);
		\$this->db->delete(\$table);
	}
		
	function count_where(\$column, \$value) 
	{
		\$table = \$this->get_table();
		\$this->db->where(\$column, \$value);
		\$query=\$this->db->get(\$table);
		\$num_rows = \$query->num_rows();
		return \$num_rows;
	}
		
	function count_all() 
	{
		\$table = \$this->get_table();
		\$query=\$this->db->get(\$table);
		\$num_rows = \$query->num_rows();
		return \$num_rows;
	}
		
	function get_max() 
	{
		\$table = \$this->get_table();
		\$this->db->select_max('id');
		\$query = \$this->db->get(\$table);
		\$row=\$query->row();
		\$id=\$row->id;
		return \$id;
	}
		
	function _custom_query(\$mysql_query) 
	{
		\$query = \$this->db->query(\$mysql_query);
		return \$query;
	}

}";
		return $data;
	}

	function repeat_for_each_field($db_fields, $method='post')
	{
		if (!$db_fields) 
		{ 
			exit; 
		}
		$field_string = '';
		switch($method)
		{
			case 'post':		
				foreach ($db_fields as $field) 
				{
					$field_string .= "		\$data['".$field."'] = \$this->input->post('".$field."', TRUE); \n";
				}
				break;
			case 'db':
				foreach ($db_fields as $field) 
				{
					$field_string .= "		\$data['".$field."'] = \$row->".$field."; \n";
				}
				break;
		}

		return $field_string;
	}

	function generate_migration() 
	{
		$this->load->helper('file');

		echo "Enter a descriptive name for migration (separated by underscores) \n";
		echo "Ex: add_users_table \n\n";
		echo "Migration Name: ";
		$migration_name = trim(fgets(STDIN));	

		echo "What is table name? \n";
		echo "Table: ";
		$table_name = trim(fgets(STDIN));

		echo "\n Enter field names in a comma-separated list -- no spaces \n";
		echo "An 'id' field will be added as a primary, auto-incrementing key so do not add one.";
		echo "Ex: field1,field2  \n";
		echo "Fields: ";
		$db_fields_csv = trim(fgets(STDIN));
		$db_fields = explode(",", $db_fields_csv);
		$data = $this->return_migration_string($migration_name, $table_name, $db_fields);
		$next_migration_version = $this->next_migration();
		if ( ! write_file("application/migrations/".$next_migration_version."_".$migration_name.".php", $data))
		{
		     echo 'Unable to write the file';
		}
		else
		{
		     echo 'File written! '."\n";
		}	
	}

	function return_migration_string($migration_name, $table_name, $db_fields)
	{
		$field_string = '';
		foreach ($db_fields as $field) 
		{
			$field_string .= "		\$this->dbforge->add_field('".$field."'); \n";
		}	
		$data = 
"<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_".ucfirst($migration_name)." extends CI_Migration 
{
    public function up()
    {
        \$this->dbforge->add_field('id int(11) unsigned NOT NULL AUTO_INCREMENT');
".$field_string."
		\$this->dbforge->add_key('id', TRUE);

    	\$this->dbforge->create_table('".$table_name."', TRUE);
	}

	public function down()
	{
	    \$this->dbforge->drop_table('".$table_name."');
	}
}";
	return $data;
	}

	function return_form_string($controller_name, $db_fields) {
		$field_string = '';
		foreach ($db_fields as $field) 
		{
			$field_string .= "echo form_input('".$field."', \$".$field.");\n";
		}	

		$data = 
		"
<?php
echo form_open(\$form_location);
".$field_string."
echo form_submit('submit', 'Submit');
echo form_close();
";

		return $data;
	}

	function run_migrations()
	{
		$this->load->library('migration');

		if ( ! $this->migration->latest() )
		{
			show_error($this->migration->error_string());
		}
	}

	function next_migration()
	{
		$this->load->helper('file');
		$migration_files = get_filenames('application/migrations');
		$number_of_migrations = count($migration_files);
		$latest_migration = $migration_files[$number_of_migrations-1];
		$migration_info = explode("_", $latest_migration);
		$version_no = $migration_info[0];
		echo 'latest version: '.$version_no."\n";
		$next_version = intval($version_no + 1);
		$next_version = (strlen($next_version) < 3) ? ( ($this->_add_zeros(3 - strlen($next_version)).$next_version ) ) : ($next_version);
		echo "\n next version: ".$next_version;
		return $next_version;
	}

	function _add_zeros($qty=2)
	{
		echo $qty."\n";
		$zeros = '';
		for ($x = 0; $x < $qty; $x++) 
		{
   		$zeros .= '0';
		}
		return $zeros;
	}

}
