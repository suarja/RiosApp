
# Deployment Guide: PHP Application on GCP with Docker and Kubernetes

This guide provides step-by-step instructions for deploying a vanilla PHP application on Google Cloud Platform using Docker and Kubernetes.

## Prerequisites

- Google Cloud account
- Google Cloud SDK installed
- Docker installed
- Kubernetes command-line tool `kubectl` configured

## Steps to Deploy

### 1. Create a Dockerfile

Create a `Dockerfile` in your project directory:

```dockerfile
# Use PHP Apache base image
FROM php:8.0-apache

# Install dependencies
RUN apt-get update && apt-get install -y libpng-dev libonig-dev libxml2-dev zip unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql gd

# Copy application source
COPY . /var/www/html

# Expose port 80
EXPOSE 80
```

### 2. Build and Push Docker Image

Build your Docker image and push it to Google Container Registry:

```bash
docker build -t gcr.io/[PROJECT-ID]/php-app:latest .
docker push gcr.io/[PROJECT-ID]/php-app:latest
```

### 3. Set Up Kubernetes Cluster

Create a GKE cluster and configure `kubectl`:

```bash
gcloud container clusters create "my-cluster" --zone "us-central1-a" --machine-type "e2-medium"
gcloud container clusters get-credentials my-cluster --zone us-central1-a
```

### 4. Deploy Application Using Kubernetes

Create a `deployment.yaml` for your application:

```yaml
apiVersion: apps/v1
kind: Deployment
metadata:
  name: php-app
spec:
  replicas: 1
  selector:
    matchLabels:
      app: php-app
  template:
    metadata:
      labels:
        app: php-app
    spec:
      containers:
      - name: php-app
        image: gcr.io/[PROJECT-ID]/php-app:latest
        ports:
        - containerPort: 80
```

Apply the deployment:

```bash
kubectl apply -f deployment.yaml
```

### 5. Configure Ingress for HTTPS

Install NGINX Ingress Controller:

```bash
kubectl apply -f https://raw.githubusercontent.com/kubernetes/ingress-nginx/controller-v0.44.0/deploy/static/provider/cloud/deploy.yaml
```

Create an `ingress.yaml` to expose your application:

```yaml
apiVersion: networking.k8s.io/v1
kind: Ingress
metadata:
  name: php-app-ingress
  annotations:
    nginx.ingress.kubernetes.io/rewrite-target: /
    cert-manager.io/cluster-issuer: "letsencrypt-prod"
    nginx.ingress.kubernetes.io/force-ssl-redirect: "true"
spec:
  tls:
  - hosts:
    - "yourdomain.com"
    secretName: php-app-tls
  rules:
  - host: "yourdomain.com"
    http:
      paths:
      - path: /
        pathType: Prefix
        backend:
          service:
            name: php-app-service
            port:
              number: 80
```

Apply the Ingress resource:

```bash
kubectl apply -f ingress.yaml
```

### 6. Debug and Monitor

Monitor your deployment and troubleshoot if necessary:

```bash
kubectl get pods
kubectl logs [POD-NAME]
```

### 7. Establish Persistent Storage and Environment Variables

Create ConfigMaps and Secrets for configuration:

```bash
kubectl create secret generic php-secrets --from-literal=db-password=yourpassword
```

### 8. Automate Certificate Management

Set up cert-manager for SSL:

```bash
kubectl apply -f https://github.com/jetstack/cert-manager/releases/download/v1.0.4/cert-manager.yaml
```

### 9. Final Testing and Go Live

Ensure your application is accessible and functioning correctly.

### 10. Ongoing Management and Scaling

Monitor performance and scale resources as needed:

```bash
kubectl scale deployment php-app --replicas=3
```

---

Save this guide as `DEPLOYMENT_GUIDE.md` in your project repository for future reference and adaptation as your project evolves.Below is a Markdown formatted document that you can use as a reference guide for deploying a PHP application on Google Cloud Platform using Docker and Kubernetes. This includes relevant commands and details for each step in the process.

---

# Deployment Guide: PHP Application on GCP with Docker and Kubernetes

This guide provides step-by-step instructions for deploying a vanilla PHP application on Google Cloud Platform using Docker and Kubernetes.

## Prerequisites

- Google Cloud account
- Google Cloud SDK installed
- Docker installed
- Kubernetes command-line tool `kubectl` configured

## Steps to Deploy

### 1. Create a Dockerfile

Create a `Dockerfile` in your project directory:

```dockerfile
# Use PHP Apache base image
FROM php:8.0-apache

# Install dependencies
RUN apt-get update && apt-get install -y libpng-dev libonig-dev libxml2-dev zip unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql gd

# Copy application source
COPY . /var/www/html

# Expose port 80
EXPOSE 80
```

### 2. Build and Push Docker Image

Build your Docker image and push it to Google Container Registry:

```bash
docker build -t gcr.io/[PROJECT-ID]/php-app:latest .
docker push gcr.io/[PROJECT-ID]/php-app:latest
```

### 3. Set Up Kubernetes Cluster

Create a GKE cluster and configure `kubectl`:

```bash
gcloud container clusters create "my-cluster" --zone "us-central1-a" --machine-type "e2-medium"
gcloud container clusters get-credentials my-cluster --zone us-central1-a
```

### 4. Deploy Application Using Kubernetes

Create a `deployment.yaml` for your application:

```yaml
apiVersion: apps/v1
kind: Deployment
metadata:
  name: php-app
spec:
  replicas: 1
  selector:
    matchLabels:
      app: php-app
  template:
    metadata:
      labels:
        app: php-app
    spec:
      containers:
      - name: php-app
        image: gcr.io/[PROJECT-ID]/php-app:latest
        ports:
        - containerPort: 80
```

Apply the deployment:

```bash
kubectl apply -f deployment.yaml
```

### 5. Configure Ingress for HTTPS

Install NGINX Ingress Controller:

```bash
kubectl apply -f https://raw.githubusercontent.com/kubernetes/ingress-nginx/controller-v0.44.0/deploy/static/provider/cloud/deploy.yaml
```

Create an `ingress.yaml` to expose your application:

```yaml
apiVersion: networking.k8s.io/v1
kind: Ingress
metadata:
  name: php-app-ingress
  annotations:
    nginx.ingress.kubernetes.io/rewrite-target: /
    cert-manager.io/cluster-issuer: "letsencrypt-prod"
    nginx.ingress.kubernetes.io/force-ssl-redirect: "true"
spec:
  tls:
  - hosts:
    - "yourdomain.com"
    secretName: php-app-tls
  rules:
  - host: "yourdomain.com"
    http:
      paths:
      - path: /
        pathType: Prefix
        backend:
          service:
            name: php-app-service
            port:
              number: 80
```

Apply the Ingress resource:

```bash
kubectl apply -f ingress.yaml
```

### 6. Debug and Monitor

Monitor your deployment and troubleshoot if necessary:

```bash
kubectl get pods
kubectl logs [POD-NAME]
```

### 7. Establish Persistent Storage and Environment Variables

Create ConfigMaps and Secrets for configuration:

```bash
kubectl create secret generic php-secrets --from-literal=db-password=yourpassword
```

### 8. Automate Certificate Management

Set up cert-manager for SSL:

```bash
kubectl apply -f https://github.com/jetstack/cert-manager/releases/download/v1.0.4/cert-manager.yaml
```

### 9. Final Testing and Go Live

Ensure your application is accessible and functioning correctly.

### 10. Ongoing Management and Scaling

Monitor performance and scale resources as needed:

```bash
kubectl scale deployment php-app --replicas=3
```
