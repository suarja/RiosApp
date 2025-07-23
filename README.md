# RiosApp - PUBG Player Statistics Tracker

[![Deploy on Zeabur](https://zeabur.com/button.svg)](https://zeabur.com/templates/RiosApp)

A PHP application that retrieves and displays PUBG player statistics in honor of the Rios family and their squad "claqué".

**Live Demo**: [https://riosapp.zeabur.app/](https://riosapp.zeabur.app/)

## 🎮 About

**RiosApp** is a tribute to Riosrap, the leader of our PUBG squad "claqué" (trash). This application allows you to search for PUBG players and view their most relevant statistics. All searches are saved in the database for historical tracking.

## ✨ Features

- 🔍 Search PUBG players by username
- 📊 View detailed player statistics and season data
- 📝 Search history tracking
- 🔐 User authentication system
- 🚀 One-click deployment with Zeabur

## 🚀 Quick Start

### One-Click Deployment with Zeabur

The easiest way to deploy RiosApp is using [Zeabur](https://zeabur.com):

1. Click the "Deploy on Zeabur" button above
2. Connect your GitHub account
3. Configure environment variables (see [Environment Variables](#environment-variables))
4. Deploy!

### Local Development

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/RiosApp.git
   cd RiosApp
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Configure environment**
   ```bash
   cp .env.example .env
   # Edit .env with your configuration
   ```

4. **Set up database**
   - Create a MySQL database
   - Update database credentials in `.env`
   - The application will automatically create required tables

5. **Run the application**
   ```bash
   # Using PHP built-in server
   php -S localhost:8000
   
   # Or configure with Apache/Nginx
   ```

## 🔧 Environment Variables

Copy `.env.example` to `.env` and configure:

```env
# PUBG API Configuration
PUBG_API_KEY=your_pubg_api_key_here

# Database Configuration
DB_HOST=localhost
DB_PORT=3306
DB_NAME=riosapp
DB_USER=your_db_user
DB_PASSWORD=your_db_password
DB_URL=mysql://user:password@host:port/database
```

### Getting a PUBG API Key

1. Visit [PUBG Developer Portal](https://developer.pubg.com/)
2. Create an account and register your application
3. Copy your API key to the `.env` file

## 📚 Documentation

- [Deployment Guide](docs/DEPLOYMENT_GUIDE.md) - Detailed GCP deployment instructions
- [Preparation Guide](docs/PREPARATION_GUIDE.md) - Application preparation for production

## 🏗️ Architecture

RiosApp is built with vanilla PHP using a custom MVC architecture:

- **Custom Router**: Handles routing with middleware support
- **Container/DI**: Service container for dependency injection
- **Database Layer**: PDO-based abstraction with prepared statements
- **Authentication**: Session-based auth with middleware protection
- **Data Classes**: Type-safe PHP classes for PUBG API responses

## 🐳 Docker Support

Build and run with Docker:

```bash
# Build the image
docker build -t riosapp .

# Run the container
docker run -p 80:80 --env-file .env riosapp
```

## 🚢 Deployment Options

### Zeabur (Recommended)

Use the one-click deploy button for the easiest deployment experience.

### Google Cloud Platform

For GCP deployment with Kubernetes:

```bash
# Use the automated deployment script
make all
# or
./cicd.sh
```

This will:
1. Commit your changes
2. Build and push Docker image to GCR
3. Deploy to your GKE cluster

See [Deployment Guide](docs/DEPLOYMENT_GUIDE.md) for detailed instructions.

## 🛠️ Development

### Project Structure

```
RiosApp/
├── src/
│   ├── controllers/    # MVC Controllers
│   ├── core/           # Core framework classes
│   ├── router/         # Routing system
│   └── data/           # Sample data
├── views/              # View templates
├── data-classes/       # PUBG API data models
├── public/             # Public assets
└── docs/              # Documentation
```

### Commands

- **Deploy**: `make all` - Full deployment to GKE
- **Install deps**: `composer install`
- **Local server**: `php -S localhost:8000`

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is open source and available under the [MIT License](LICENSE).

## 🙏 Acknowledgments

- Riosrap and the "claqué" squad for the inspiration
- PUBG API for providing player statistics
- The PHP community for excellent tools and libraries

---

Made with ❤️ for the PUBG community