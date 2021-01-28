<?php

declare(strict_types=1);

namespace Kreait\Firebase\Contract;

interface Project
{
    public function auth(?string $tenantId = null): Auth;

    public function database(?string $url = null): Database;

    public function firestore(): Firestore;

    public function messaging(): Messaging;

    public function remoteConfig(): RemoteConfig;

    public function storage(): Storage;
}
