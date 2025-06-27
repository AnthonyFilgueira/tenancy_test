<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name : The name of the Repository}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crea un Repository y su Interface de forma automática';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = Str::studly($this->argument('name'));

        $interfaceDir = app_path('Repositories/Contracts');
        $repositoryDir = app_path('Repositories');

        $interfacePath = "{$interfaceDir}/{$name}RepositoryInterface.php";
        $repositoryPath = "{$repositoryDir}/{$name}Repository.php";

        if (File::exists($interfacePath) || File::exists($repositoryPath)) {
            $this->error('❌ El Repository o la Interface ya existen.');
            return;
        }

        // Crear carpetas si no existen
        if (!File::isDirectory($interfaceDir)) {
            File::makeDirectory($interfaceDir, 0755, true);
        }

        if (!File::isDirectory($repositoryDir)) {
            File::makeDirectory($repositoryDir, 0755, true);
        }

        // Crear Interface
        File::put($interfacePath, $this->getInterfaceTemplate($name));

        // Crear Repository
        File::put($repositoryPath, $this->getRepositoryTemplate($name));

        $this->info("✅ Repository y Interface creados correctamente:");
        $this->line("- {$interfacePath}");
        $this->line("- {$repositoryPath}");
    }

    protected function getInterfaceTemplate(string $name): string
    {
        return <<<PHP
            <?php

            namespace App\Repositories\Contracts;

            interface {$name}RepositoryInterface
            {
                public function all();
                public function find(int \$id);
                public function create(array \$data);
                public function update(int \$id, array \$data);
                public function delete(int \$id);
                public function paginage(int \$records);
            }
            PHP;
    }

    protected function getRepositoryTemplate(string $name): string
    {

        $nameLowerCase = strtolower($name);
        return <<<PHP
        <?php

        namespace App\Repositories;

        use App\Models\\{$name};
        use App\Repositories\Contracts\\{$name}RepositoryInterface;

        class {$name}Repository implements {$name}RepositoryInterface
        {
            private \${$nameLowerCase};
    
            public function __construct({$name} \${$nameLowerCase})
            {
                \$this->{$nameLowerCase} = \${$nameLowerCase};
            }
            public function all()
            {
                return \$this->{$nameLowerCase}::all();
            }

            public function find(\$id)
            {
                return \$this->{$nameLowerCase}::findOrFail(\$id);
            }

            public function create(array \$data)
            {
                return \$this->{$nameLowerCase}::create(\$data);
            }

            public function update(int \$id, array \$data)
            {
                \${$nameLowerCase} = \$this->find(\$id);
                \${$nameLowerCase}->update(\$data);
                return \${$nameLowerCase};
            }

            public function delete(\$id)
            {
                \${$nameLowerCase} = \$this->find(\$id);
                return \${$nameLowerCase}->delete();
            }

            public function paginate(int \$records)
            {
                return \$this->{$nameLowerCase}::paginate(\$records);
            }
        }
        PHP;
    }
}
