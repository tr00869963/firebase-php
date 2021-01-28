<?php

declare(strict_types=1);

namespace Kreait\Firebase\Project;

final class ProjectConfig implements Config
{
    private const ENV_DATABASE_URL = 'FIREBASE_DATABASE_URL';
    private const ENV_SERVICE_ACCOUNT = 'FIREBASE_CREDENTIALS';

    /** @var string|null */
    private $defaultDatabaseUrl;

    /** @var string|null */
    private $serviceAccount;

    private function __construct()
    {
    }

    public static function new(): self
    {
        return new self();
    }

    public static function fromEnvironment(): self
    {
        $config = new self();

        if ($serviceAccount = self::getenv(self::ENV_SERVICE_ACCOUNT)) {
            $config->serviceAccount = $serviceAccount;
        }

        if ($databaseUrl = self::getenv(self::ENV_DATABASE_URL)) {
            $config->defaultDatabaseUrl = $databaseUrl;
        }

        return $config;
    }

    public function defaultDatabaseUrl(): ?string
    {
        return $this->defaultDatabaseUrl;
    }

    public function withDefaultDatabaseUrl(string $defaultDatabaseUrl): self
    {
        $config = clone $this;
        $config->defaultDatabaseUrl = $defaultDatabaseUrl;

        return $config;
    }

    public function serviceAccount(): ?string
    {
        return $this->serviceAccount;
    }

    public function withServiceAccount(string $serviceAccount): self
    {
        $config = clone $this;
        $config->serviceAccount = $serviceAccount;

        return $config;
    }

    private static function getenv(string $name): ?string
    {
        $value = $_SERVER[$name] ?? $_ENV[$name] ?? \getenv($name);

        if ($value !== false && $value !== null) {
            return (string) $value;
        }

        return null;
    }
}
