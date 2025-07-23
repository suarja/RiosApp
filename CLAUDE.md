# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Common Development Commands

### Deployment and CI/CD
- **Deploy to production**: `make all` or `./cicd.sh` - Commits, builds Docker image, pushes to GCR, and deploys to GKE
- **Local Docker build**: `docker buildx build --platform linux/amd64 -t gcr.io/riosapp-baks/riosapp:latest .`
- **Manual deployment**: `kubectl set image deployment/riosapp-deployment riosapp=gcr.io/riosapp-baks/riosapp:latest --record`

### Dependency Management
- **Install dependencies**: `composer install` (requires PHP Composer)
- **Add new dependency**: `composer require vendor/package`

### Local Development
- **Run locally**: Start a PHP server (e.g., `php -S localhost:8000`) or use Apache/Nginx
- **Environment setup**: Copy `.env.example` to `.env` and configure database and PUBG API credentials

## High-Level Architecture

This is a PUBG player statistics application built with vanilla PHP using a custom MVC architecture:

### Core Components

1. **Router System** (`src/router/`)
   - Custom router handles GET/POST/PUT/DELETE requests
   - Routes defined in `src/router/routes.php`
   - Middleware support for authentication (auth/gest)

2. **Container & Dependency Injection** (`src/core/`)
   - `Container.php`: Service container for dependency injection
   - `App.php`: Static facade for container access
   - Services bound: Database connection, PUBG API key

3. **Database Layer** (`src/core/Database.php`)
   - PDO-based database abstraction
   - Custom Statement wrapper for consistent fetch operations
   - Player-specific methods for CRUD operations
   - Automatic table creation

4. **Authentication System** (`src/core/auth/`)
   - Session-based authentication
   - Middleware for route protection
   - Auth routes require logged-in users, Gest routes for guests only

5. **Controllers** (`src/controllers/`)
   - Landing page controller
   - Player controllers (index, show, create, store)
   - Registration/login controllers

6. **Data Classes** (`data-classes/`)
   - PHP classes for PUBG API response mapping
   - Type-safe data structures for players, seasons, stats

### Environment Configuration

The application detects production (Kubernetes) vs development environments:
- **Production**: Reads environment variables directly
- **Development**: Uses `.env` file via phpdotenv

Required environment variables:
- `PUBG_API_KEY`: API key for PUBG API
- `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASSWORD`: MySQL connection

### Deployment Architecture

- **Platform**: Google Cloud Platform (GCP)
- **Container**: Docker with PHP 8.0 Apache base image
- **Orchestration**: Kubernetes (GKE)
- **Registry**: Google Container Registry (GCR)
- **SSL**: cert-manager with Let's Encrypt
- **Ingress**: NGINX Ingress Controller

The `cicd.sh` script handles the complete deployment pipeline:
1. Commits code to Git
2. Builds Docker image with buildx for linux/amd64
3. Pushes to GCR
4. Updates Kubernetes deployment

### Key Files to Understand

- `index.php`: Entry point, sets up routing and session
- `functions.php`: Helper functions (base_path, view, dd, etc.)
- `src/core/bootstrap.php`: Container setup and service bindings
- `config.php`: Environment variable loading and database configuration