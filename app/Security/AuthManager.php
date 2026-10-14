<?php

namespace App\Security;

use App\Enums\AppAccessEnum;
use Jnana\Security\AuthManager as FrameworkAuthManager;

/**
 * App-specific convenience wrapper around the framework's AuthManager.
 *
 * The framework's `userAuthLevel(\BackedEnum $accessLevel)` is generic on
 * purpose — it doesn't know about this app's AppAccessEnum. These two
 * shortcuts belong here, in the app, not in the framework package.
 *
 * Wire this in place of Library\Security\AuthManager wherever AuthManager
 * is bound/injected (e.g. config/Dependencies.php), or just type-hint
 * App\Security\AuthManager in controllers/services that need these helpers.
 */
class AuthManager extends FrameworkAuthManager
{
    public function isAdminAuthLevel(): bool
    {
        return $this->userAuthLevel(AppAccessEnum::ADMIN);
    }

    public function isCompanyAuthLevel(): bool
    {
        return $this->userAuthLevel(AppAccessEnum::COMPANY);
    }
}
