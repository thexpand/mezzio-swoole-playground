# Example application with Mezzio + Swoole + Docker

Main points that are covered:
- Dockerfile, based on the Swoole alpine image, which installs the project dependencies (inotify for hot reloading, Composer 2, dependencies from composer.json)
- Basic Mezzio skeleton (API-only, no templates)
- Install and configure `mezzio/mezzio-swoole` package + development configuration with hot reloading
- Load environment variables from .env via a custom Start command (suitable for development environment)
