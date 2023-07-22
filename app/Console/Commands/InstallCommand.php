<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Roles;
use Database\Seeders\ProductionSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install {--force : Force the installation to run even if the app is already installed }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (! $this->canConnectToDatabase()) {
            $this->error('Can\'t connect to database!');
            $this->comment(sprintf('Is your connection properly configured? (Using the %s driver)', config('database.default', 'unknown')));
            return Command::FAILURE;
        }

        DB::transaction(function () {
            $isInteractive = $this->input->isInteractive();

            if (! $isInteractive) {
                $this->info('Running in non-interactive mode. Default values will be used instead of asking questions.');
            }

            if ($this->isAlreadyInstalled()) {
                if ($this->option('force')) {
                    if (app()->environment('production')) {
                        $this->warn('<error>DANGER:</> You are running this command in production mode! Proceeding with the command will wipe the database!');
                        if (! $this->confirm('Are you sure you want to wipe the database and continue?')) {
                            $this->comment('Aborting...');
                            return Command::FAILURE;
                        }
                    } else {
                        $this->warn('App is already installed, but --force was passed. The installation will proceed after wiping the database.');
                    }
                    $this->info('Wiping database...');
                    $wipeExit = $this->call('db:wipe');
                    if ($wipeExit !== Command::SUCCESS) {
                        $this->error('Failed to wipe database!');
                        return Command::FAILURE;
                    } else {
                        $this->info('Database wiped successfully! Continuing with installation...');
                    }
                } else {
                    $this->error('App is already installed!');
                    return Command::FAILURE;
                }
            }

            $adminName = $this->ask('Enter Admin user name', 'admin');
            $adminEmail = $this->ask('Enter Admin user email', 'admin@'.parse_url(config('app.url'))['host']);
            $adminPassword = $this->secret('Enter Admin user password');

            if ($isInteractive && ! $adminPassword) {
                do {
                    $adminPassword = $this->secret('Enter Admin user password');
                } while (! $adminPassword);
            } else if (! $isInteractive) {
                $adminPassword ??= config('auth.default_admin_password');
                $this->comment('Admin user will be created with following credentials:');
                $this->line("  Name: $adminName");
                $this->line("  Email: $adminEmail");
                if ($adminPassword === 'password') {
                    $this->line("  Password: $adminPassword");
                    $this->warn('Please change password to something secure!');
                } else {
                    $this->line('  Password: ********');
                }
                $this->newLine();
            }

            $this->info('Installing app...');
            $this->info('Migrating database...');
            $migrationExitCode = $this->callSilently('migrate:fresh', ['--force' => true]);
            if ($migrationExitCode !== 0) {
                $this->error('Something went wrong with the migration.');
                return $migrationExitCode;
            }

            $this->info('Creating admin user...');
            User::create([
                'name' => $adminName,
                'email' => $adminEmail,
                'password' => $adminPassword,
                'email_verified_at' => now(),
                'role' => Roles::Admin->value,
            ]);

            $this->info('Creating default pages...');
            app(ProductionSeeder::class)->run();

            $this->info('All done! Go build something amazing!');
        });
    }

    protected function isAlreadyInstalled(): bool
    {
        try {
            // Check if necessary migrations are already run
            return DB::table('migrations')->count() > 0;
        } catch (QueryException) {
            return false;
        }
    }

    protected function canConnectToDatabase(): bool
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (QueryException) {
            return false;
        }
    }
}
