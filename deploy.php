<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'my_project');

// Project repository
set('repository', 'git@github.com:pyRadiohead/deployer-test.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

set('shared_files', [
	'wp-config.php',
]);
set('shared_dirs', [
	'wp-content/uploads',
]);

// Writable dirs by web server
set('writable_dirs', [
	'wp-content',
]);

// Remove unnecessary stuff
set('clear_paths', [
	'.git',
	'.github',
	'.gitignore',
	'deploy.php',
]);
set('allow_anonymous_stats', false);

// Hosts

host('production')
	->hostname('207.154.209.72')
	->port(22)
	->user('deployer')
	->identityFile('~/.ssh/id_rsa')
	->set('deploy_path', '/var/www/deployer')
	->set('keep_releases', 3);
    

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);
//Install wordpress
desc('Install WordPress');
task('deploy:wp',
'touch test.txt;');

//after('deploy:writable', 'deploy:wp');

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
