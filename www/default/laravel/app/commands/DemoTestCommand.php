<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DemoTestCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'demo:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demo test command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $this->info('info');
        $this->comment('comment');
        $this->error('error');
    }
}
