"""
VOYD Image Compression Script
------------------------------
Compresses all images in a folder (and subfolders) WITHOUT changing format.
- PNG stays PNG (lossless optimization, transparency preserved)
- JPG/JPEG stays JPG/JPEG (high-quality compression, no visible quality loss)
- WebP stays WebP
- A backup of every original file is kept before overwriting, just in case.

USAGE:
    1. Install Pillow if you don't have it:
       pip install Pillow

    2. Run this script and pass your images folder path:
       python compress_images.py "C:\\xampp\\htdocs\\voyd\\public\\assets\\images"

    3. Check the summary printed at the end (total size before/after).
       Your original files are safely copied into a "originals_backup" folder
       next to your images folder, in case anything looks off.
"""

import os
import sys
import shutil
from PIL import Image

# These are large legitimate design assets, not malicious files - safe to raise the limit
Image.MAX_IMAGE_PIXELS = None

# ---------------- SETTINGS ----------------
JPEG_QUALITY = 82       # 80-85 = visually near-lossless, big size savings
PNG_OPTIMIZE = True     # lossless PNG optimization (no quality loss at all)
WEBP_QUALITY = 82
MAKE_BACKUP = True      # keep a safety copy of originals before overwriting
# -------------------------------------------

VALID_EXTENSIONS = {".jpg", ".jpeg", ".png", ".webp"}


def human_size(num_bytes):
    for unit in ["B", "KB", "MB", "GB"]:
        if num_bytes < 1024:
            return f"{num_bytes:.1f}{unit}"
        num_bytes /= 1024
    return f"{num_bytes:.1f}TB"


def compress_image(filepath):
    ext = os.path.splitext(filepath)[1].lower()
    original_size = os.path.getsize(filepath)
    temp_path = filepath + ".tmp_compress"

    try:
        img = Image.open(filepath)
        img.load()  # force full load before we start writing to a temp file

        if ext in (".jpg", ".jpeg"):
            # Convert to RGB if needed (JPG doesn't support transparency/alpha)
            work_img = img.convert("RGB") if img.mode in ("RGBA", "P") else img
            work_img.save(
                temp_path,
                "JPEG",
                quality=JPEG_QUALITY,
                optimize=True,
                progressive=True,
            )

        elif ext == ".png":
            # Keep exact mode (preserves transparency if present)
            img.save(
                temp_path,
                "PNG",
                optimize=PNG_OPTIMIZE,
            )

        elif ext == ".webp":
            img.save(
                temp_path,
                "WEBP",
                quality=WEBP_QUALITY,
                method=6,
            )

        img.close()

        new_size = os.path.getsize(temp_path)

        if new_size < original_size:
            # Compression actually helped - replace the original
            os.replace(temp_path, filepath)
            return original_size, new_size, None
        else:
            # Compression didn't help (common on tiny/already-optimized files)
            # Keep the original untouched
            os.remove(temp_path)
            return original_size, original_size, None

    except Exception as e:
        if os.path.exists(temp_path):
            os.remove(temp_path)
        return original_size, original_size, str(e)


def main():
    if len(sys.argv) < 2:
        print("Usage: python compress_images.py \"<path-to-images-folder>\"")
        sys.exit(1)

    root_folder = sys.argv[1]

    if not os.path.isdir(root_folder):
        print(f"Error: folder not found -> {root_folder}")
        sys.exit(1)

    backup_folder = None
    if MAKE_BACKUP:
        parent = os.path.dirname(os.path.normpath(root_folder))
        folder_name = os.path.basename(os.path.normpath(root_folder))
        backup_folder = os.path.join(parent, f"{folder_name}_originals_backup")
        if not os.path.exists(backup_folder):
            print(f"Creating backup at: {backup_folder}")
            shutil.copytree(root_folder, backup_folder)
        else:
            print(f"Backup already exists at: {backup_folder} (skipping backup step)")

    total_before = 0
    total_after = 0
    processed = 0
    errors = []

    for dirpath, _, filenames in os.walk(root_folder):
        for filename in filenames:
            ext = os.path.splitext(filename)[1].lower()
            if ext not in VALID_EXTENSIONS:
                continue

            filepath = os.path.join(dirpath, filename)
            before, after, error = compress_image(filepath)

            if error:
                errors.append((filepath, error))
                print(f"  [SKIP - error] {filepath}: {error}")
                continue

            total_before += before
            total_after += after
            processed += 1

            saved_pct = (1 - after / before) * 100 if before > 0 else 0
            print(f"  {filename}: {human_size(before)} -> {human_size(after)} ({saved_pct:.0f}% smaller)")

    print("\n----------------------------------------")
    print(f"Files processed: {processed}")
    print(f"Total size before: {human_size(total_before)}")
    print(f"Total size after:  {human_size(total_after)}")
    if total_before > 0:
        print(f"Overall reduction: {(1 - total_after / total_before) * 100:.1f}%")
    if errors:
        print(f"\n{len(errors)} file(s) had errors and were left untouched:")
        for fp, err in errors:
            print(f"  - {fp}: {err}")
    if backup_folder:
        print(f"\nOriginals safely backed up at: {backup_folder}")
    print("----------------------------------------")


if __name__ == "__main__":
    main()
