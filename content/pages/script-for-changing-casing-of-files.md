---
slug: posts/script-for-changing-casing-of-files
title: 'Script for Changing Casing of Files'
type: post
category_slug: tips
excerpt:
updated_at: 2025-02-03
created_at: 2025-02-03
---

Here's a script you can use to automatically fix the file casings in a given directory. Let's say you have a directory like this:

```
resources/
├── js/
│   ├── Components/
│   |   ├── button.tsx
```

The script would fix it to be like so:

```
resources/
├── js/
│   ├── components/
│   |   ├── Button.tsx
```

Folder names become kebab-case and file names become PascalCase.

Usage:

```bash
./fix-casings.sh folderName
```

```bash
#!/bin/bash

# Function to convert to kebab-case
to_kebab_case() {
    echo "$1" | sed -E 's/([a-z0-9])([A-Z])/\1-\2/g' | tr '[:upper:]' '[:lower:]' | tr ' ' '-' | tr '_' '-'
}

# Function to convert to PascalCase
to_pascal_case() {
    filename=$1
    # Split into name and extension
    name="${filename%.*}"
    extension="${filename##*.}"
    
    # If there's no extension, just process the name
    if [ "$name" = "$extension" ]; then
        echo "$name" | perl -pe 's/(^|[-_]|\s+)([a-z])/\U$2/g'
    else
        # Process name and reattach extension
        processed_name=$(echo "$name" | perl -pe 's/(^|[-_]|\s+)([a-z])/\U$2/g')
        echo "${processed_name}.${extension}"
    fi
}

DIR=$1

# Get all files tracked by git
git ls-files "$DIR" | while read -r file; do
    dir=$(dirname "$file")
    filename=$(basename "$file")
    
    # Skip if it's in the .git directory
    if [[ "$dir" == .git* ]]; then
        continue
    fi
    
    # Convert directory path to kebab-case
    new_dir=$(echo "$dir" | tr '/' '\n' | while read -r part; do
        if [ "$part" != "." ]; then
            to_kebab_case "$part"
        else
            echo "."
        fi
    done | tr '\n' '/' | sed 's/\/$//')
    
    # Convert filename to PascalCase
    new_filename=$(to_pascal_case "$filename")
    
    # Construct new path
    new_path="${new_dir}/${new_filename}"
    
    # Only rename if there's a change
    if [ "$file" != "$new_path" ]; then
        # Use temporary name to avoid case-sensitivity issues
        temp_path="${new_dir}/temp_${RANDOM}_${new_filename}"
        git mv "$file" "$temp_path" 2>/dev/null
        git mv "$temp_path" "$new_path" 2>/dev/null
        echo "Renamed: $file → $new_path"
    fi
done
```