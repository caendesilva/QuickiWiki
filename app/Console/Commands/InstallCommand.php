<?php

namespace App\Console\Commands;

use App\Models\User;
use Database\Seeders\SiteSeeder;
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
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
                $this->error('App is already installed!');
                return Command::FAILURE;
            }

            $adminName = $this->ask('Enter Admin user name', 'admin');
            $adminEmail = $this->ask('Enter Admin user email', 'admin@localhost');
            $adminPassword = $this->secret('Enter Admin user password');

            if ($isInteractive && ! $adminPassword) {
                do {
                    $adminPassword = $this->secret('Enter Admin user password');
                } while (! $adminPassword);
            } else if (! $isInteractive) {
                $adminPassword ??= 'password';
                $this->comment('Admin user will be created with following credentials:');
                $this->line("  Name: $adminName");
                $this->line("  Email: $adminEmail");
                $this->line("  Password: $adminPassword");
                $this->warn('Please change password to something secure!');
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
            $user = User::create([
                'name' => $adminName,
                'email' => $adminEmail,
                'password' => $adminPassword,
                'email_verified_at' => now(),
                // TODO: Add role
            ]);

            $this->info('Creating default pages...');
            app(SiteSeeder::class)->run($user);

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
