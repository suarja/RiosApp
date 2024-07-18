#!/bin/bash

# Variables for configuration
PROJECT_ID="riosapp-baks"
IMAGE_NAME="riosapp"
CLUSTER_NAME="riosapp-cluster"
CLUSTER_ZONE="europe-west9-a"
DOCKERFILE_PATH="."  # Directory containing the Dockerfile
DEPLOYMENT_NAME="riosapp-deployment"
CONTAINER_NAME="riosapp"

# Check if Google Cloud is configured
GCLOUD_CONFIGURED=$(gcloud auth list --filter=status:ACTIVE --format="value(account)")

# Commit changes to the local Git repository
echo "Committing changes to Git..."
git add .
read -p "Enter commit message: " commit_message
git commit -m "$commit_message"
commit_id=$(git rev-parse --short HEAD)
echo "Commit ID: $commit_id"

# Build the Docker image with commit ID as the tag
IMAGE_FULL_NAME="gcr.io/$PROJECT_ID/$IMAGE_NAME:$commit_id"
echo "Building Docker image $IMAGE_FULL_NAME..."
docker build -t $IMAGE_FULL_NAME $DOCKERFILE_PATH
if [ $? -ne 0 ]; then
    echo "Docker build failed. Exiting..."
    exit 1
fi

# Ensure gcloud is authenticated
if [[ -z "$GCLOUD_CONFIGURED" ]]; then
  echo "Authenticating with Google Cloud..."
  gcloud auth login
  gcloud auth configure-docker
fi

# Push the image to Google Container Registry
echo "Pushing image to GCR..."
docker push $IMAGE_FULL_NAME
if [ $? -ne 0 ]; then
    echo "Failed to push Docker image. Exiting..."
    exit 1
fi

# Get current Kubernetes context to check if it's set to the correct cluster
CURRENT_CONTEXT=$(kubectl config current-context)

# Get credentials for GKE cluster if the context is not set correctly
if [[ "$CURRENT_CONTEXT" != "$CLUSTER_NAME" ]]; then
  echo "Getting credentials for GKE cluster..."
  gcloud container clusters get-credentials $CLUSTER_NAME --zone $CLUSTER_ZONE --project $PROJECT_ID
fi

# Update the Kubernetes deployment to use the new image
echo "Updating Kubernetes deployment..."
kubectl set image deployment/$DEPLOYMENT_NAME $CONTAINER_NAME=$IMAGE_FULL_NAME --record
if [ $? -ne 0 ]; then
    echo "Failed to update Kubernetes deployment. Exiting..."
    exit 1
fi

echo "Deployment successful! Deployed image: $IMAGE_FULL_NAME"
