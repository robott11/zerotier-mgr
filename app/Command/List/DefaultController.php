<?php

namespace App\Command\List;

use Minicli\Command\CommandController;
use Minicli\Output\Helper\TableHelper;

class DefaultController extends CommandController
{
    public function handle(): void
    {
        $networks = $this->app->zeroTier->getNetworks();
        
        $table = new TableHelper();
        $table->addHeader(['ID', 'NOME']);
        foreach ($networks as $network) {
            $table->addRow([$network->id, $network->config->name]);
        }

        $this->display('REDES');
        $this->rawOutput($table->getFormattedTable());
        $this->newLine();
    }
}
