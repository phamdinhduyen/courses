<?php
namespace Modules;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider{
    private $middlewares = [
        //
    ];
    private $commands = [
        // 
    ];
    public function boot(){
        $modules = $this->getModules();
        if(!empty($modules)){
            foreach ($modules as $module){
                $this->registerModule($module);
            }
        }
    }

    public function register(){
        $this->app->singleton(
            UserRepository::class
        );
    }
    private function getModules(){
        $directories =  array_map('basename',File::directories(__DIR__));
        return $directories;
    }
    // registerModule
    private function registerModule($module){
        $modulePath = __DIR__ . "/{$module}";
        // khai bao router
        if (File::exists($modulePath . '/routes/routes.php')){
            $this->loadRoutesFrom($modulePath . '/routes/routes.php');
        }
        // khai bao migrations
        if(File::exists($modulePath. '/migrations')){
            $this->loadMigrationsFrom($modulePath . '/migrations');
        }
        // khai bao languages
        if(File::exists($modulePath. '/resources/lang')){
            $this->loadTranslationsFrom($modulePath . '/resources/lang', strtolower($module));
            $this->loadJsonTranslationsFrom($modulePath. '/resources/lang');
        }
        // khai bao views
        if (File::exists($modulePath . '/resources/views')){
            $this->loadViewsFrom($modulePath .'/resources/views', strtolower($module));
        }
        // khai bao helpers
        if (File::exists($modulePath . '/helpers')){
            $helperList = File::allFiles($modulePath . '/helpers');
            if(!empty($helperList)){
                foreach ($helperList as $helper) {
                    $file = $helper->getPathname();
                    require $file;
                }
            }
        }

    }
    // register configs
    private function registerConfig($module){
        $configPath = __DIR__.'/'.$module . '/configs';
            if(File::exists($configPath)){
                $configFile = array_map('basename',File::allFiles($configPath));
                foreach($configFile as $config){
                    $alias = basename($config, '.php');
                    $this->mergeConfigFrom($configPath . '/' . $config, $alias);
                }
            }
    }

    private function registerMiddlewares(){
        if(!empty($this->middlewares)){
            foreach($this->middlewares as $key => $middleware){
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }

}