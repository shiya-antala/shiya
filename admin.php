<?php
session_start();

// Define constants for credentials (FOR DEMO/SMALL APP ONLY - USE HASHING & ENV VARS IN PRODUCTION)
// !!! IMPORTANT: In a real production environment, NEVER store passwords in plain text.
// Use password_hash() to store hashed passwords and password_verify() to check them.
define('ADMIN_USERNAME', 'shiya');
define('ADMIN_PASSWORD', 'shiya123'); // Replace with a strong password!

// --- AUTHENTICATION ---
if (!isset($_SESSION['admin_logged_in'])) {
    $login_error = '';
    if (isset($_POST['admin_login'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        // Basic authentication (FOR DEMO ONLY)
        if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
            $_SESSION['admin_logged_in'] = true;
            // Regenerate session ID after successful login to prevent session fixation attacks
            session_regenerate_id(true); 
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        } else {
            $login_error = "Invalid username or password!";
        }
    }

    // Display login form if not logged in
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border: none; border-radius: 1rem; }
        .card-header { border-bottom: none; border-top-left-radius: 1rem; border-top-right-radius: 1rem; }
        .btn-primary { background-color: #a05d2f; border-color: #a05d2f; }
        .btn-primary:hover { background-color: #8b4513; border-color: #8b4513; }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h4>KTADS Admin Login</h4>
                </div>
                <div class="card-body p-4">
                    <?php if (!empty($login_error)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($login_error); ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" id="username" name="username" class="form-control" required autofocus>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" name="admin_login" class="btn btn-primary w-100 py-2">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
    exit; // Ensure nothing else is processed if login form is shown
}

// If reached here, admin is logged in.
// --- UPLOAD HELPERS ---
function get_upload_error_message($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE: return 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
        case UPLOAD_ERR_FORM_SIZE: return 'The uploaded file exceeds the MAX_FILE_SIZE directive in the HTML form.';
        case UPLOAD_ERR_PARTIAL: return 'The uploaded file was only partially uploaded.';
        case UPLOAD_ERR_NO_FILE: return 'No file was uploaded. Please select a file.';
        case UPLOAD_ERR_NO_TMP_DIR: return 'Missing a temporary folder for uploads.';
        case UPLOAD_ERR_CANT_WRITE: return 'Failed to write file to disk. Check server permissions in the temporary directory.';
        case UPLOAD_ERR_EXTENSION: return 'A PHP extension stopped the upload.';
        default: return 'An unknown upload error occurred.';
    }
}

function save_image($file, $image_type) {
    // Check for upload errors first
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return get_upload_error_message($file['error']);
    }

    // Check if temp file exists and is not empty
    if (empty($file["tmp_name"]) || !file_exists($file["tmp_name"])) {
        return "Error: No temporary file found. This might be due to an upload error or server configuration (e.g., upload_max_filesize, post_max_size in php.ini).";
    }

    // Validate file size (64MB limit - consistent with MAX_FILE_SIZE in form)
    // This is a server-side check after client-side MAX_FILE_SIZE
    if ($file['size'] > 67108864) { // 64 MB in bytes
        return "Error: File size exceeds 64MB limit. Current file size: " . round($file['size'] / 1024 / 1024, 2) . " MB.";
    }

    // Get file extension
    $imageFileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    
    // Verify it's actually an image using getimagesize
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return "Error: File is not a valid image. (getimagesize check failed)";
    }

    // Get actual MIME type of the uploaded file for better security
    // Requires fileinfo extension to be enabled in php.ini (usually default)
    if (!extension_loaded('fileinfo')) {
        return "Error: PHP 'fileinfo' extension is not enabled. Cannot verify MIME type for security.";
    }
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    if (!$finfo) {
        return "Error: Failed to open fileinfo database. Cannot verify MIME type.";
    }
    $mime_type = finfo_file($finfo, $file["tmp_name"]);
    finfo_close($finfo);

    $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mime_type, $allowed_mimes)) {
        return "Error: Uploaded file has an unsupported MIME type ('" . htmlspecialchars($mime_type) . "'). Only JPEG, PNG, GIF, WEBP are allowed.";
    }

    // Optional: Ensure the extension matches the MIME type for consistency and security
    $known_mime_to_ext = [
        'image/jpeg' => ['jpg', 'jpeg'],
        'image/png' => ['png'],
        'image/gif' => ['gif'],
        'image/webp' => ['webp']
    ];

    $is_extension_valid_for_mime = false;
    if (isset($known_mime_to_ext[$mime_type]) && in_array($imageFileType, $known_mime_to_ext[$mime_type])) {
        $is_extension_valid_for_mime = true;
    }

    if (!$is_extension_valid_for_mime) {
        // This is a strict check. You might relax it if you trust the source more and rely mainly on MIME.
        return "Error: File extension (." . htmlspecialchars($imageFileType) . ") does not match its detected content type (" . htmlspecialchars($mime_type) . ").";
    }

    // Create upload directory if it doesn't exist
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) {
        if (!mkdir($target_dir, 0755, true)) { // 0755 for permissions, true for recursive
            return "Error: Cannot create upload directory ('" . htmlspecialchars($target_dir) . "'). Please check server permissions.";
        }
    }

    // Check if directory is writable
    if (!is_writable($target_dir)) {
        return "Error: Upload directory ('" . htmlspecialchars($target_dir) . "') is not writable. Please check server permissions.";
    }

    // Generate safe filename to prevent path traversal and overwriting
    $original_filename_clean = preg_replace('/[^a-zA-Z0-9_-]/', '', pathinfo($file["name"], PATHINFO_FILENAME));
    if (empty($original_filename_clean)) {
        $original_filename_clean = "uploaded_image"; // Fallback if original name is all special chars
    }
    // Prepend image_type for better organization/identification and append timestamp for uniqueness
    $new_filename = $image_type . "_" . $original_filename_clean . "_" . time() . "." . $imageFileType;
    $target_path = $target_dir . $new_filename;

    // Move uploaded file from temporary location to target directory
    if (move_uploaded_file($file["tmp_name"], $target_path)) {
        // Update JSON data file with the new path
        $images = [];
        $data_file = 'image_data.json';
        if (file_exists($data_file)) {
            $json_content = file_get_contents($data_file);
            $images = json_decode($json_content, true);
            if ($images === null && json_last_error() !== JSON_ERROR_NONE) {
                // Log JSON decoding errors if file exists but is malformed
                error_log("Error decoding image_data.json in save_image: " . json_last_error_msg());
                $images = []; // Reset to empty array if JSON is invalid
                // You might choose to add a user-facing error about JSON corruption here
            } else if ($images === null) {
                // Handles empty JSON file case
                $images = [];
            }
        }
        
        // Remove old image if it existed and is different from the new one
        if (isset($images[$image_type]) && file_exists($images[$image_type])) {
            // Check if the old path is different from the new one to prevent deleting the newly uploaded file
            if (realpath($images[$image_type]) !== realpath($target_path)) {
                if (!unlink($images[$image_type])) {
                    error_log("Warning: Admin panel could not delete old image file: " . $images[$image_type]);
                    // User might still see success, but the old file might remain
                }
            }
        }
        
        $images[$image_type] = $target_path; // Store the new path
        
        // Save updated data back to JSON file
        if (file_put_contents($data_file, json_encode($images, JSON_PRETTY_PRINT)) === false) {
            error_log("Error saving image_data.json: Could not write to file. Check permissions for '$data_file'.");
            return "Error: Cannot save image data to JSON file. Check permissions for '$data_file'.";
        }
        
        return true; // Indicates success
    } else {
        // This 'else' block catches failures from move_uploaded_file()
        // Possible causes: target directory not writable, disk quota exceeded, network issues, etc.
        error_log("Error moving uploaded file: From " . $file["tmp_name"] . " to " . $target_path . ". Debug info: PHP error: " . $file['error']);
        return "Error: Failed to move uploaded file. Check destination directory permissions, disk space, and server logs for details.";
    }
}

// --- HANDLE UPLOAD ---
$success = $error = '';
if (isset($_POST['upload_image'])) {
    // Check if the file input actually has a file selected and an image_type is provided
    if (isset($_FILES["image"]) && !empty($_POST['image_type'])) {
        // The save_image function will handle specific upload errors (UPLOAD_ERR_NO_FILE, etc.)
        $result = save_image($_FILES["image"], $_POST['image_type']);
        if ($result === true) {
            $success = "Image uploaded successfully! Page may need refresh to see updated image paths.";
        } else {
            $error = $result; // $result contains the detailed error message
        }
    } else {
        $error = "No file selected for upload or image type was not specified.";
    }
}

// --- LOGOUT ---
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Load existing images for display in the admin panel
$images = [];
$data_file = 'image_data.json';
if (file_exists($data_file)) {
    $json_content = file_get_contents($data_file);
    $images = json_decode($json_content, true);
    if ($images === null && json_last_error() !== JSON_ERROR_NONE) {
        // Log JSON error if file exists but is malformed
        error_log("JSON Decode Error in admin.php (display): " . json_last_error_msg() . " - File: " . $data_file);
        $images = []; // Fallback to empty array if JSON is invalid
        // Optionally display a warning to the admin
        $error = (!empty($error) ? $error . "<br>" : "") . "Warning: The image_data.json file might be corrupted. Please check its content.";
    } else if ($images === null) {
         $images = []; // Handle case of empty or malformed JSON that json_decode returns null for
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KTADS Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .upload-section { background: #fff; padding: 20px; border-radius: 10px; margin-bottom: 30px; }
        .image-preview { 
            width: 100%; 
            height: auto; 
            max-height: 150px; 
            display: none; /* Hidden by default, shown when file selected */
            object-fit: contain; /* Use contain to see whole image, or cover if you prefer crop */
            border-radius: 8px; 
            border: 1px solid #ccc; 
            margin-bottom: 10px; /* Space below preview */
        }
        .section-header { 
            background: linear-gradient(135deg, #6e3b09, #a05d2f); 
            color: white; 
            padding: 15px; 
            border-radius: 10px; 
            margin-bottom: 20px; 
            display: flex; /* Ensure button aligns */
            justify-content: space-between;
            align-items: center;
        }
        .current-image { 
            max-width: 100%; 
            height: auto; 
            max-height: 150px; 
            object-fit: contain; /* Use contain to see whole image, or cover if you prefer crop */
            border-radius: 8px; 
            border: 1px solid #ccc; 
            margin-top: 10px; /* Space above current image */
        }
        .card-header h6 {
            margin-bottom: 0;
            font-size: 0.95rem; /* Slightly smaller for card headers */
            color: #555;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="section-header">
        <h2>KTADS Admin Panel - Manage Images</h2>
        <a href="?logout=1" class="btn btn-light btn-sm">Logout</a>
    </div>

    <?php if ($success): ?><div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>

    <?php
    // Added 'hero_main_image' to the list of manageable images
    $sections = [
        "Hero Section Image" => [
            'hero_main_image' => 'Hero Main Background'
        ],
        "Portfolio Section Images" => [
            'modern_kitchens' => 'Modern Kitchens', 'modern_bathroom' => 'Modern Bathroom',
            'decorative_hardware' => 'Decorative Hardware', 'woodspace_cabinetry' => 'Woodspace Cabinetry',
            'modern_rooms' => 'Modern Rooms', 'minimal_offices' => 'Minimal Offices',
            'modern_kitchens2' => 'Modern Kitchens 2', 'working_places' => 'Working Places',
            'modern_bedrooms' => 'Modern Bedrooms'
        ],
        "Archive Section Images" => [
            'archive_main' => 'Archive Main Image', 'archive_thumb1' => 'Archive Thumbnail 1', 'archive_thumb2' => 'Archive Thumbnail 2'
        ],
        "Testimonials Section Images" => [
            'testimonial1' => 'Testimonial Avatar 1', 'testimonial2' => 'Testimonial Avatar 2'
        ],
        "Achievement Section Images" => [
            'achievement1' => 'Achievement 1', 'achievement2' => 'Achievement 2', 'achievement3' => 'Achievement 3'
        ]
    ];

    foreach ($sections as $sectionTitle => $items): ?>
    <div class="upload-section">
        <h3><?php echo htmlspecialchars($sectionTitle); ?></h3>
        <div class="row">
            <?php foreach ($items as $key => $label): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header">
                        <h6><?php echo htmlspecialchars($label); ?></h6>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="image_type" value="<?php echo htmlspecialchars($key); ?>">
                            <input type="hidden" name="MAX_FILE_SIZE" value="67108864"> <div class="mb-2">
                                <input type="file" name="image" class="form-control" accept="image/jpeg, image/png, image/gif, image/webp" onchange="previewImage(this)" required>
                            </div>
                            <img class="image-preview" alt="Preview" />
                            <button type="submit" name="upload_image" class="btn btn-sm btn-primary w-100">Upload New Image</button>
                        </form>
                        <?php if (isset($images[$key]) && file_exists($images[$key])): ?>
                        <div class="mt-3 text-center">
                            <small class="text-muted d-block mb-1">Current Image:</small>
                            <img src="<?php echo htmlspecialchars($images[$key]) . '?t=' . time(); ?>" class="current-image" alt="Current image for <?php echo htmlspecialchars($label); ?>">
                            <p class="small text-muted mt-2 mb-0"><?php echo htmlspecialchars(basename($images[$key])); ?></p>
                        </div>
                        <?php else: ?>
                        <div class="text-center text-muted small mt-3">No image uploaded yet.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        // Find the image preview element within the same card/parent form
        const preview = input.closest('form').querySelector('.image-preview');
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block'; // Show the image preview
        };
        reader.readAsDataURL(input.files[0]); // Corrected: Always read the first file
    } else {
        // If no file is selected, hide the preview
        const preview = input.closest('form').querySelector('.image-preview');
        preview.style.display = 'none';
        preview.src = ''; // Clear the image source
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>