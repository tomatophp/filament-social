<?php

namespace TomatoPHP\FilamentSocial\Console;

use Illuminate\Console\Command;

class FilamentSocialInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'filament-social:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'install package and publish assets';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Running migrations');
        $this->call('migrate', ['--force' => true]);

        $this->info('Filament Social installed successfully.');

        return self::SUCCESS;
    }
}
