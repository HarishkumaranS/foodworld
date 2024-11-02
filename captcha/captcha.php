<?php
// Start session to store the CAPTCHA code
session_start();

// Regenerate session ID to enhance security
session_regenerate_id(true);

// Generate random CAPTCHA string
$captcha_code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 6);

// Store the CAPTCHA code in session
$_SESSION['captcha_code'] = $captcha_code;

// Create a smaller image
$image_width = 150;  // Reduced width
$image_height = 40;  // Reduced height
$image = imagecreatetruecolor($image_width, $image_height);

// Set background and text color
$bg_color = imagecolorallocate($image, 255, 255, 255); // white
$text_color = imagecolorallocate($image, 0, 0, 0);     // black

// Fill the background color
imagefilledrectangle($image, 0, 0, $image_width, $image_height, $bg_color);

// Add some noise (optional)
for ($i = 0; $i < 50; $i++) {
    $noise_color = imagecolorallocate($image, rand(100, 200), rand(100, 200), rand(100, 200));
    imagesetpixel($image, rand(0, $image_width), rand(0, $image_height), $noise_color);
}

// Add the CAPTCHA code to the image
$font_path = './font.ttf'; // Ensure this path is correct
if (file_exists($font_path)) {
    imagettftext($image, 16, 0, 10, 30, $text_color, $font_path, $captcha_code); // Adjusted font size and position
} else {
    die("Font file not found.");
}

// Set the content type header
header('Content-Type: image/png');

// Output the image in PNG format
imagepng($image);

// Free memory
imagedestroy($image);
?>
