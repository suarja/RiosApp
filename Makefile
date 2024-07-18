# Variables
SCRIPT_PATH=./cicd.sh

# Set default make action to 'help'
default: help

help:
	@echo "Makefile commands:"
	@echo "make run-script - Execute the CI/CD script"
	@echo "make all - Build and deploy using the script"

run-script:
	@chmod +x $(SCRIPT_PATH)
	@./$(SCRIPT_PATH)

all: run-script
