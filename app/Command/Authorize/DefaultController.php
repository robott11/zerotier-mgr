<?php

namespace App\Command\Authorize;

use Minicli\Command\CommandController;

class DefaultController extends CommandController
{
    public function handle(): void
    {
        if (empty($this->hasParam('network')) || empty($this->hasParam('member'))) {
            $this->error('Please, inform the network and member id');
            $this->error('Usage: ./zerotier-mgr authorize network="abcdef123456789" member="abcdef123456789"');
            return;
        }

        $network = $this->getParam('network');
        $member = $this->getParam('member');
        
        if ($this->app->zeroTier->authorizeMember($network, $member)) {
            $this->display('boa');
            return;
        }
    }
}
