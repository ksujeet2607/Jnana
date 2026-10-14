# Jnana Application Documentation

This guide explains how to build and operate an application created from the `jnana/jnana` project skeleton. It complements the [framework documentation](https://github.com/ksujeet2607/Jnana) and describes application-owned files and conventions.

## Guides

- [Getting started](docs/getting-started.md) — installation, local server, and project structure.
- [Configuration and environment](docs/configuration.md) — `.env`, config files, paths, logging and runtime modes.
- [Controllers and routing](docs/controllers-and-routing.md) — adding pages and API endpoints with attributes.
- [Services, DI and application context](docs/services-and-di.md) — services, providers, bindings and user context.
- [Database and authentication](docs/database-and-authentication.md) — Doctrine setup, file/database authentication and security.
- [Deployment](docs/deployment.md) — Apache/IIS/PHP server configuration and production checklist.
- [Troubleshooting](docs/troubleshooting.md) — common boot, routing, path and database errors.

## Core rule

Application code belongs in this repository; reusable framework code belongs in the Composer package `jnana/framework`. Do not edit `vendor/jnana/framework` as the normal way to add business behavior. Add application services, controllers, entities, middleware or bindings instead. Framework bugs should be fixed in the framework repository and released as a new package version.
