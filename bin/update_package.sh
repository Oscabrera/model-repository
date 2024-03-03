#!/bin/bash

# Read version and update type from the semver file
version=$(jq -r '.version' ../semver)
update_type=$(jq -r '.last-update-type' ../semver)

# Output current version
echo "Current version: $version"

# Check the update type and perform corresponding actions
case "$update_type" in
  "patch")
    # Actions for patch update
    echo "Performing a patch update..."
    # Add your commands here to update the package for a patch
    ;;
  "minor")
    # Actions for minor update
    echo "Performing a minor update..."
    # Add your commands here to update the package for a minor update
    ;;
  "major")
    # Actions for major update
    echo "Performing a major update..."
    # Add your commands here to update the package for a major update
    ;;
  *)
    # Unknown or unspecified update type
    echo "Error: Unknown or unspecified update type in semver."
    exit 1
    ;;
esac