<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\GeneralModel;
use App\Models\AdminModel;

class MakeModule extends BaseCommand
{
    protected $group       = 'Generators';
    protected $name        = 'make:module';
    protected $description = 'Creates a new Module within the Modules Directory.';
    protected $arguments = ['name' => 'The module name.'];

    public function run(array $params)
    {
        // CLI::write('PHP Version: ' . CLI::color(PHP_VERSION, 'yellow'));
        // CLI::write('CI Version: ' . CLI::color(\CodeIgniter\CodeIgniter::CI_VERSION, 'yellow'));
        // CLI::write('APPPATH: ' . CLI::color(APPPATH, 'yellow'));
        // CLI::write('SYSTEMPATH: ' . CLI::color(SYSTEMPATH, 'yellow'));
        // CLI::write('ROOTPATH: ' . CLI::color(ROOTPATH, 'yellow'));
        // CLI::write('Included files: ' . CLI::color(count(get_included_files()), 'yellow'));

        $ok = $this->update_modules();

        $modulename = $params;
        $mod = new GeneralModel();

        if (count($modulename) == 0) {
            $module = CLI::prompt('Please enter the module name?', null, ['required']);
        } else {
            $module = $params[0];
        }

        $check = $mod->check_module($module);

        if ($check) {
            CLI::write('A Module with this name has already been created', 'yellow');
        } else {
            $done = $this->module_directories($module);
            $ook = $this->update_modules();
            CLI::write($done, 'green');
        }
    }


    //Function to Create Directories
    function module_directories($module)
    {
        $modulesPath = APPPATH . 'Modules';

        $modulePath = $modulesPath . '/' . $module;

        // Create module directory
        mkdir($modulePath);

        // Create subdirectories
        $directories = ['Controllers', 'Models', 'Views/Admin'];
        foreach ($directories as $dir) {
            mkdir($modulePath . '/' . $dir, 0777, true); // Recursive directory creation
        }

        // Create index.php file in Views/Admin directory
        file_put_contents($modulePath . '/Views/Admin/index.php', $this->index_html());

        // Create Administrator.php file in Controllers directory
        file_put_contents($modulePath . '/Controllers/Administrator.php', $this->generate_module_controller_content($module));

        // Create $module_m.php file in Models directory
        file_put_contents($modulePath . '/Models/' . $module . '_m.php', $this->generate_module_model_content($module));

        $tok = $this->create_module_table($module);

        return $module . ' Module has been Created Successfully';
    }

    //Create Databse Table
    function create_module_table($module) {
        $db = \Config\Database::connect();
    
        // Define table name
        $tableName = strtolower($module);
    
        // Get the Database Forge object
        $forge = \Config\Database::forge();
    
        // Drop existing table if exists
        // $db->query('DROP TABLE IF EXISTS `' . $tableName . '`');
    
        // Define table fields

        $fields = [
            // 'id' => [
            //     'type' => 'INT',
            //     'constraint' => 50,
            //     'unsigned' => true,
            //     'auto_increment' => true
            // ],
            'name' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_on' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
            'modified_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ],
        ];
    
        // Add table primary key
        $forge->addField('id');
        $forge->addField($fields);
        // $forge->addKey('id', true);
    
        // // Add other fields to the table
        // foreach ($fields as $fieldName => $fieldDetails) {
        //     $forge->addField($fieldName, $fieldDetails);
        // }

        // Create the table
        $attributes = ['ENGINE' => 'InnoDB'];
        $forge->createTable($tableName, true,$attributes);
    }    

    //Function to get HTML for index.php
    function index_html()
    {
        $indexContent = '<?php echo $this->extend(\'layouts/admin/default\'); ?>' . PHP_EOL;
        $indexContent .= '<?php echo $this->section(\'content\'); ?>' . PHP_EOL;
        $indexContent .= '<div class="row">' . PHP_EOL;
        $indexContent .= '</div>' . PHP_EOL;
        $indexContent .= '<?php echo $this->endSection(); ?>' . PHP_EOL;

        return $indexContent;
    }

    //Function to generate Model Content
    function generate_module_model_content($module)
    {
        $modulee = strtolower($module);

        $content = <<<EOT
    <?php
    
    namespace App\Modules\\{$module}\Models;
    
    use CodeIgniter\Model;
    
    class {$module}_m extends Model
    {
        protected \$DBGroup          = 'default';
        protected \$table            = '{$modulee}'; // Adjusted to use the module name in lowercase
        protected \$primaryKey       = 'id';
        protected \$useAutoIncrement = true;
        protected \$returnType       = 'array';
        protected \$useSoftDeletes   = false;
        protected \$protectFields    = true;
        protected \$allowedFields    = ['name', 'description', 'created_by', 'modified_by', 'created_at', 'updated_at'];
    
        // Dates
        protected \$useTimestamps = false;
        protected \$dateFormat    = 'datetime';
        protected \$createdField  = 'created_at';
        protected \$updatedField  = 'updated_at';
        protected \$deletedField  = 'deleted_at';
    
        // Validation
        protected \$validationRules      = [];
        protected \$validationMessages   = [];
        protected \$skipValidation       = false;
        protected \$cleanValidationRules = true;
    
        // Callbacks
        protected \$allowCallbacks = true;
        protected \$beforeInsert   = [];
        protected \$afterInsert    = [];
        protected \$beforeUpdate   = [];
        protected \$afterUpdate    = [];
        protected \$beforeFind     = [];
        protected \$afterFind      = [];
        protected \$beforeDelete   = [];
        protected \$afterDelete    = [];
    
        // Custom method to insert data into the table
        public function insert_data(\$data)
        {
            \$this->insert(\$data);
    
            return \$this->getInsertID();
        }
    }
    EOT;

        return $content;
    }


    //Function to generate Module Controller
    function generate_module_controller_content($module)
    {
        $content = <<<EOT
    <?php
    
    namespace App\Modules\\{$module}\Controllers;
    
    use App\Controllers\AdministratorController;
    use App\Modules\\{$module}\Models\\{$module}_m;
    
    use CodeIgniter\API\ResponseTrait;
    
    class Administrator extends AdministratorController
    {
        use ResponseTrait;
    
        //Index Function 
        public function index()
        {
            \$data = [];
            helper(['form']);
    
            return view('App\Modules\\{$module}\Views\Admin\index', \$data);
        }
    }
    EOT;

        return $content;
    }


    //Function to Update Modules
    function update_modules()
    {
        $admin = new AdminModel();

        // List of controllers that are not modules
        $nonmodules = ['AdminController', 'BaseController', 'Home'];

        // Define the path to the modules directory
        $modulesPath = APPPATH . 'Modules';

        // Initialize variable to count modules updated
        $modulesUpdated = 0;

        // Iterate through each module directory
        $moduleDirectories = new \DirectoryIterator($modulesPath);

        foreach ($moduleDirectories as $moduleDirectory) {
            // Skip . and .. directories
            if ($moduleDirectory->isDot()) {
                continue;
            }

            // Get module name from directory name
            $moduleName = $moduleDirectory->getBasename();

            // Define the path to the controllers directory within the module
            $controllersPath = $moduleDirectory->getPathname() . '/Controllers';

            // Iterate through the controllers directory of the module
            $controllers = new \DirectoryIterator($controllersPath);

            foreach ($controllers as $controller) {
                if ($controller->isFile() && $controller->getExtension() === 'php') {
                    // Extract the controller class name from the file
                    $controllerFileName = $controller->getBasename('.php');

                    if ($controllerFileName !== "Administrator") {
                        continue;
                    }

                    $controllerClass = "\\App\\Modules\\$moduleName\\Controllers\\$controllerFileName";

                    // Check if the class exists and is not in nonmodules

                    if (class_exists($controllerClass) && !in_array($controllerFileName, $nonmodules)) {
                        // if (!in_array($controllerFileName, $nonmodules)) {
                        // Check if the module exists in the database
                        $moduleExists = $admin->find_module($moduleName, $controllerClass);
                        if (!$moduleExists) {
                            // If the module doesn't exist, insert it into the database
                            $data = [
                                'module_name' => $moduleName,
                                'module_path' => $controllerClass,
                                'created_on' => time(),
                                // 'created_by' => auth()->user()->id
                            ];

                            $ok = $admin->create_module($data);

                            if ($ok) {
                                $modulesUpdated++;
                            }
                        }
                    }
                }
            }
        }

        return $modulesUpdated . ' Updated';
    }
}
