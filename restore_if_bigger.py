"""
Restore-If-Bigger Script
-------------------------
Run this AFTER compress_images.py if you want to fix any files that
accidentally ended up larger than the original (this can happen on tiny
or already-optimized images).

It compares your images folder against the "_originals_backup" folder
and restores the original ONLY for files where the backup is smaller.
Everything else (the successfully compressed files) is left untouched.

USAGE:
    python restore_if_bigger.py "C:\\xampp\\htdocs\\voyd\\public\\assets\\images"
"""

import os
import sys
import shutil


def human_size(num_bytes):
    for unit in ["B", "KB", "MB", "GB"]:
        if num_bytes < 1024:
            return f"{num_bytes:.1f}{unit}"
        num_bytes /= 1024
    return f"{num_bytes:.1f}TB"


def main():
    if len(sys.argv) < 2:
        print("Usage: python restore_if_bigger.py \"<path-to-images-folder>\"")
        sys.exit(1)

    images_folder = sys.argv[1]
    parent = os.path.dirname(os.path.normpath(images_folder))
    folder_name = os.path.basename(os.path.normpath(images_folder))
    backup_folder = os.path.join(parent, f"{folder_name}_originals_backup")

    if not os.path.isdir(backup_folder):
        print(f"Error: backup folder not found -> {backup_folder}")
        sys.exit(1)

    restored = 0
    checked = 0

    for dirpath, _, filenames in os.walk(backup_folder):
        rel_dir = os.path.relpath(dirpath, backup_folder)
        for filename in filenames:
            backup_filepath = os.path.join(dirpath, filename)
            current_filepath = os.path.join(images_folder, rel_dir, filename) if rel_dir != "." else os.path.join(images_folder, filename)

            if not os.path.exists(current_filepath):
                continue

            checked += 1
            backup_size = os.path.getsize(backup_filepath)
            current_size = os.path.getsize(current_filepath)

            if backup_size < current_size:
                shutil.copy2(backup_filepath, current_filepath)
                restored += 1
                print(f"  Restored: {filename} ({human_size(current_size)} -> {human_size(backup_size)})")

    print("\n----------------------------------------")
    print(f"Files checked: {checked}")
    print(f"Files restored to original (smaller than compressed version): {restored}")
    print("----------------------------------------")


if __name__ == "__main__":
    main()
