<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application_production', 'html');

// Project repository
set('repository', 'git@bitbucket.org:eastplayer/yezy-mvp.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false);

// numbers of releases
set('keep_releases', 3);

// Default Branch
set('branch', 'master');

set('default_timeout', null);

// Shared files/dirs between deploys
add('shared_files', ['.env']);

add('shared_dirs', [
    'storage',
    //'public/images',
    'public/upload',
    'public/video',
    'public/media',
    'bootstrap/cache',
]);

add('writable_dirs', [
    'storage',
    'public/images',
    'public/upload',
    'public/video',
    'public/media',
    'bootstrap/cache',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);

add('copy_dirs', [
    'storage',
    'public/images',
    'public/upload',
    'public/video',
    'public/media',
    'bootstrap/cache',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);


// List of hosts
host('production')
    ->hostname('137.184.196.120')
    ->user('root')
    ->stage('production')
    ->set('deploy_path', '/var/www/{{application_production}}')
    ->set('http_user', 'www-data')
    ->set('writable_use_sudo', true)
    ->set('cleanup_use_sudo', true)
    ->set('writable_mode', 'chmod')
    ->set('branch', 'master')
    ->forwardAgent(false);

/**
 * Helper tasks
 */

// build assets npm
desc('NPM install and Build Assets');
task('npm:build:assets', function () {
    run('cd {{release_path}} && npm install');
    run('cd {{release_path}} && npm run production');
})->once();

// artisan migrate
desc('Execute artisan migrate');
task('artisan:migrate', function () {
    run('{{bin/php}} {{release_path}}/artisan migrate --force');
})->once();

// seed database
desc('Execute artisan db:seed');
task('artisan:db:seed', function () {
    $output = run('{{bin/php}} {{release_path}}/artisan db:seed --force');
    writeln('<info>' . $output . '</info>');
});

// queue restart
desc('Execute artisan queue:restart');
task('artisan:queue:restart', function () {
    run('{{bin/php}} {{release_path}}/artisan queue:restart');
});

// Allow laravel to write log and access to cache
desc('Files permissions');
task('fix:permission', function () {
    run('chmod -R a=r,u+w,a+X {{release_path}}');
    $output = run('ls -la {{release_path}}');
    writeln('<info>' . $output . '</info>');
});

desc('Fix permission for current directory (ubuntu only)');
task('fix:current:permission', function () {
    // anyone can read, user add write and anyone add execute for all files and dirs
    run('sudo chmod -R a=r,u+w,a+X {{release_path}}');
    // change group owner to webservers group
    run('sudo chgrp -R www-data {{release_path}}');
    // allow read write execute for webservers on wp-content
    run('sudo chmod -R ug+rwx {{release_path}}/storage {{release_path}}/bootstrap/cache');
});

desc('Fix permission for shared directory (ubuntu only)');
task('fix:shared:permission', function () {
    run('cd {{deploy_path}}/shared && sudo chgrp -R www-data storage bootstrap/cache public');
    run('cd {{deploy_path}}/shared && sudo chmod -R ug+rwx storage bootstrap/cache public');
});


desc('Restart supervisor');
task('deploy:restart:supervisor', function () {
    run('sudo supervisorctl restart all');
    run('{{bin/php}} {{release_path}}/artisan horizon:publish');
});


task('deploy', [
    // outputs the branch and IP address to the command line
    'deploy:info',
    // preps the environment for deploy, creating release and shared directories
    'deploy:prepare',
    // adds a .lock file to the file structure to prevent numerous deploys executing at once
    'deploy:lock',
    // removes outdated release directories and creates a new release directory for deploy
    'deploy:release',
    // clones the project Git repository
    'deploy:update_code',
    // loops around t he list of shared directories defined in the config file
    // and generates symlinks for each
    'deploy:shared',
    // loops around the list of writable directories defined in the config file
    // and changes the owner and permissions of each file or directory
    'deploy:writable',

    'fix:permission',

    'fix:current:permission',

    'fix:shared:permission',
    // if Composer is used on the site, the Composer install command is executed
    'deploy:vendors',

    // npm build assets
    // 'npm:build:assets',

    // migrate database
    'artisan:migrate',

    // seed database
    'artisan:optimize:clear',
    // 'artisan:db:seed',
    // loops around release and removes unwanted directories and files
    'deploy:clear_paths',
    // links the deployed release to the "current" symlink
    'deploy:symlink',
    // deletes the unlock file, allowing further deploys to be executed
    'deploy:unlock',
    // loops around a list of release directories and removes any which are now outdated
    'cleanup',

    'reload:php-fpm',

    'reload:nginx',

    'deploy:restart:supervisor',
    // can be used by the user to assign custom tasks to execute on successful deployments
    'success'
]);

after('deploy:failed', 'deploy:unlock');

// Reload PHP-FPM
task('reload:php-fpm', function () {
    $stage = input()->hasArgument('stage')
        ? input()->getArgument('stage')
        : null;

    switch ($stage) {
        case 'production':
            run('sudo systemctl reload php7.4-fpm.service');
            break;
        default:
            run('echo this is development server');
            run('sudo systemctl reload php7.4-fpm.service');
            break;
    }
})->desc('PHP7 FPM reloaded');

task('reload:nginx', function () {
    $stage = input()->hasArgument('stage')
        ? input()->getArgument('stage')
        : null;

    switch ($stage) {
        case 'production':
            run('sudo systemctl reload nginx.service');
            break;
        default:
            run('echo this is development server');
            run('sudo systemctl reload nginx.service');
            break;
    }
})->desc('Reload NGINX');
