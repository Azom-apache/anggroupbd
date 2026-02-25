<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function Termwind\{render};

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

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
        render(<<<'HTML'
    <table>
        <thead>
            <tr>
                <th class="bg-red-500">Task</th>
                <th class="text-green-600">Status</th>
            </tr>
        </thead>
        <tr>
            <th>Termwind</th>
            <td>✓ Done</td>
        </tr>
    </table>
HTML);
    }
}
