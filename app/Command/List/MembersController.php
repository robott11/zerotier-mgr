<?php

namespace App\Command\List;

use Minicli\Command\CommandController;
use Minicli\Output\Helper\TableHelper;

class MembersController extends CommandController
{
    public function handle(): void
    {
        if (empty($this->hasParam('network'))) {
            $this->error('Please, inform the network id.');
            $this->error('Usage: ./zerotier-mgr list members network="abcdef123456789"');
            return;
        }

        $network = $this->getParam('network');

        $members = $this->app->zeroTier->getMembers($network);

        $this->display('MEMBER FROM ' . $network . ' NETWORK');
        $this->printMembersTable($members);
    }

    private function printMembersTable(array $members): void
    {
        $table = new TableHelper();
        $table->addHeader(['ID', 'NAME', 'AUTHORIZED', 'MANAGED IPS', 'LAST SEEN', 'PHYSICAL IP']);

        foreach ($members as $member) {
            $managed_ips =  '';
            foreach ($member->config->ipAssignments as $ip) {
                $managed_ips .= empty($managed_ips) ? $ip : ' - ' . $ip;
            }

            $table->addRow([
                (string)$member->config->id,
                (string)$member->name,
                $member->config->authorized ? 'YES' : 'NO',
                $managed_ips,
                (string)$member->lastSeen,
                (string)$member->physicalAddress
            ]);
        }

        $this->rawOutput($table->getFormattedTable());
        $this->newline();
    }
}
