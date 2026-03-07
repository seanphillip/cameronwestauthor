#!/bin/bash

# ─────────────────────────────────────────
#  Cameron West Author Site — Deploy Script
#  Just run this whenever you make changes!
# ─────────────────────────────────────────

echo ""
echo "🚀 Cameron West Site Deployer"
echo "─────────────────────────────"
echo ""

# Ask what changed
read -p "What did you change? (e.g. 'updated contact page'): " msg

# Default message if they just hit enter
if [ -z "$msg" ]; then
  msg="site update"
fi

# Stage all changes
git add .

# Commit
git commit -m "$msg"

# Push to GitHub (triggers auto-deploy to BlueHost)
git push

echo ""
echo "✅ Done! Your changes are live at cameronwestauthor.com"
echo ""
