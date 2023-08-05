<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create module CLI';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this -> argument('name');
        if( File::exists(base_path('modules/'.$name))){
            $this->error('Module already exists !');
        } else {
            File::makeDirectory(base_path('modules/' . $name), 0755, true, true);
            //config
            $configFolder = base_path('modules/'.$name.'/configs');
            if(!File::exists($configFolder)){
                File::makeDirectory($configFolder,0755, true, true);
            }
            // helper
            $helperFolder = base_path('modules/'.$name.'/helpers');
            if(!File::exists($helperFolder)){
                File::makeDirectory($helperFolder,0755, true, true);
            }
            // migration
            $migrationFolder = base_path('modules/'.$name.'/migrations');
            if(!File::exists($migrationFolder)){
                File::makeDirectory($migrationFolder,0755, true, true);
            }
            //resources
            $resourcesFolder = base_path('modules/'.$name.'/resources');
            if(!File::exists($resourcesFolder)){
                File::makeDirectory($resourcesFolder,0755, true, true);
                //language
                $LanguageFolder = base_path('modules/'.$name.'/resources/lang');
                if(!File::exists($LanguageFolder)){
                    File::makeDirectory($LanguageFolder,0755, true, true);
                }
                //views
                $ViewsFolder = base_path('modules/'.$name.'/resources/views');
                if(!File::exists($ViewsFolder)){
                    File::makeDirectory($ViewsFolder,0755, true, true);
                }
            }
           //routes
            $RoutesFolder = base_path('modules/'.$name.'/routes');
            if(!File::exists($RoutesFolder)){
                File::makeDirectory($RoutesFolder,0755, true, true);
                // create file routes.php
                $RoutesFile = base_path('modules/'.$name.'/routes/routes.php');
                if(!File::exists($RoutesFile)){
                    File::put($RoutesFile, "<?php \n use Illuminate\Support\Facades\Route;");
                }
            }
            //src
            $srcFolder = base_path('modules/'.$name.'/src');
            if(!File::exists($srcFolder)){
                File::makeDirectory($srcFolder,0755, true, true);
                // command
                $commandFolder = base_path('modules/'.$name.'/src/Commands');
                if(!File::exists($commandFolder)){
                    File::makeDirectory($commandFolder,0755, true, true);
                }
                // Http
                $HttpFolder = base_path('modules/'.$name.'/src/Http');
                if(!File::exists($HttpFolder)){
                    File::makeDirectory($HttpFolder,0755, true, true);
                    //Controllers
                    $controllersFolder = base_path('modules/'.$name.'/src/Http/Controllers');
                    // if(!File::exists($controllersFolder)){
                    //     File::makeDirectory($controllersFolder,0755, true, true);
                    // }
                
                    if(!File::exists($controllersFolder)){
                        File::makeDirectory($controllersFolder,0755, true, true);
                        //Module controller
                        $controllerFile = base_path('modules/'.$name.'/src/Http/Controllers/'.$name.'Controller.php');
                        if(!File::exists( $controllerFile)){
                            $moduleControllerContent = file_get_contents ( app_path('Console/Templates/ModuleController.txt'));
                            $moduleControllerContent = str_replace('{module}', $name, $moduleControllerContent);
                            File::put($controllerFile, $moduleControllerContent );
                        }
                    
                    }
                    //Middlewares
                    $MiddlewaresFolder = base_path('modules/'.$name.'/src/Http/Middlewares');
                    if(!File::exists($MiddlewaresFolder)){
                        File::makeDirectory($MiddlewaresFolder,0755, true, true);
                    }
                }
                // Models
                $ModelsFolder = base_path('modules/'.$name.'/src/Models');
                if(!File::exists($ModelsFolder)){
                    File::makeDirectory($ModelsFolder,0755, true, true);
                }
                // Repositories
                $repositoriesFolder = base_path('modules/'.$name.'/src/Repositories');
                if(!File::exists($repositoriesFolder)){
                    File::makeDirectory($repositoriesFolder,0755, true, true);
                    //Module Repository
                    $repositoryFile = base_path('modules/'.$name.'/src/Repositories/'.$name.'Repository.php');
                    if(!File::exists( $repositoryFile)){
                        $moduleRepositoryContent = file_get_contents ( app_path('Console/Templates/ModuleRepotory.txt'));
                        $moduleRepositoryContent = str_replace('{module}', $name, $moduleRepositoryContent);
                        File::put($repositoryFile, $moduleRepositoryContent );
                    }
                    //Module RepositoryInterface
                    $repositoryInterFaceFile = base_path('modules/'.$name.'/src/Repositories/'.$name.'RepositoryInterface.php');
                    if(!File::exists( $repositoryInterFaceFile)){
                        $moduleRepositoryInterFaceContent = file_get_contents ( app_path('Console/Templates/ModuleRepositoryInterface.txt'));
                        $moduleRepositoryInterFaceContent = str_replace('{module}', $name, $moduleRepositoryInterFaceContent);
                        File::put($repositoryInterFaceFile, $moduleRepositoryInterFaceContent );
                    }
                }
            }
            
            $this->info('Module create successfully');
           
        }
    }
}