<?php

declare(strict_types=1);

namespace App\Controllers;

use Jnana\Http\Request;
use Jnana\Http\Response;
use Jnana\Routes\Get;
use Jnana\Security\SecurityService;

final class SecurityController
{
    public function __construct(private SecurityService $securityService)
    {
    }

    /**
     * Refresh the CSRF token for the current session.
     * This endpoint never restores an expired authentication session.
     */
    #[Get('/security/csrf-token')]
    public function csrfToken(): Response
    {
        $token = $this->securityService->refreshToken();

        return (new Response())
            ->setStatusCode(200)
            ->addHeader('Content-Type', 'application/json')
            ->addHeader('Cache-Control', 'no-store, private')
            ->addHeader('Pragma', 'no-cache')
            ->setBody([
                'token' => $token,
                'field' => $this->securityService->getTokenFieldName(),
                'header' => 'X-CSRF-Token',
                'expires_in' => $this->securityService->getTokenLifetime(),
            ]);
    }
}
