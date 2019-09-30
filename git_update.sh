#!/bin/bash
OUTPUT="$(date)"
git add *
git commit -m "Files Added Automatically"
git push origin master

