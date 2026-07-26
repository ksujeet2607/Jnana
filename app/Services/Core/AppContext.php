<?php

namespace App\Services\Core;

use App\Entities\Support\User;
use Doctrine\ORM\EntityManagerInterface;
use Library\Contracts\AppContextInterface;
use Library\Contracts\Authenticatable;
use Library\Security\AuthManager;

class AppContext implements AppContextInterface
{
    private ?User $user = null;
    private bool $loaded = false;

    public function __construct(
        private readonly AuthManager $authManager,
        private readonly EntityManagerInterface $em,
    ) {
    }

    public function em(): EntityManagerInterface
    {
        return $this->em;
    }

    public function authManager(): AuthManager
    {
        return $this->authManager;
    }

    public function user(): ?Authenticatable
    {
        $this->loadUserIfNeeded();
        return $this->user;
    }

    private function loadUserIfNeeded(): void
    {
        if ($this->loaded) {
            return;
        }

        $this->loaded = true;

        $authData = $this->authManager->getUser();
        if (!$authData || empty($authData['id'])) {
            // File-strategy demo users (config/users.json) have no numeric
            // 'id', so this stays null until you switch to 'database' auth
            // and log in against a real users table.
            return;
        }

        $this->user = $this->em->getRepository(User::class)->find($authData['id']);
    }
}
