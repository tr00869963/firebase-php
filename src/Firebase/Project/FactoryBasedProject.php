<?php

declare(strict_types=1);

namespace Kreait\Firebase\Project;

use Kreait\Firebase\Contract;
use Kreait\Firebase\Factory;

final class FactoryBasedProject implements Contract\Project
{
    /** @var Factory */
    private $factory;

    public function __construct(Config $config)
    {
        $this->factory = $this->buildFactory($config);
    }

    public function auth(?string $tenantId = null): Contract\Auth
    {
        if ($tenantId) {
            return $this->factory->withTenantId($tenantId)->createAuth();
        }

        return $this->factory->createAuth();
    }

    public function database(?string $url = null): Contract\Database
    {
        if ($url) {
            return $this->factory->withDatabaseUri($url)->createDatabase();
        }

        return $this->factory->createDatabase();
    }

    public function firestore(): Contract\Firestore
    {
        return $this->factory->createFirestore();
    }

    public function messaging(): Contract\Messaging
    {
        return $this->factory->createMessaging();
    }

    public function remoteConfig(): Contract\RemoteConfig
    {
        return $this->factory->createRemoteConfig();
    }

    public function storage(): Contract\Storage
    {
        return $this->factory->createStorage();
    }

    private function buildFactory(Config $config): Factory
    {
        $factory = new Factory();

        if ($defaultDatabaseUrl = $config->defaultDatabaseUrl()) {
            $factory = $factory->withDatabaseUri($defaultDatabaseUrl);
        }

        if ($serviceAccount = $config->serviceAccount()) {
            $factory = $factory->withServiceAccount($serviceAccount);
        }

        return $factory;
    }
}
