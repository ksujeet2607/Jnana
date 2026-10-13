# Jnana Application Documentation

This guide explains how to build and operate an application created from the `jnana/jnana` project skeleton. It complements the [framework documentation](https://github.com/ksujeet2607/Jnana) and describes application-owned files and conventions.

## Guides

- [Getting started](getting-started.md) — installation, local server, and project structure.
- [Configuration and environment](configuration.md) — `.env`, config files, paths, logging and runtime modes.
- [Controllers and routing](controllers-and-routing.md) — adding pages and API endpoints with attributes.
- [Services, DI and application context](services-and-di.md) — services, providers, bindings and user context.
- [Database and authentication](database-and-authentication.md) — Doctrine setup, file/database authentication and security.
- [Deployment](deployment.md) — Apache/IIS/PHP server configuration and production checklist.
- [Troubleshooting](troubleshooting.md) — common boot, routing, path and database errors.

## Core rule

Application code belongs in this repository; reusable framework code belongs in the Composer package `jnana/framework`. Do not edit `vendor/jnana/framework` as the normal way to add business behavior. Add application services, controllers, entities, middleware or bindings instead. Framework bugs should be fixed in the framework repository and released as a new package version.
