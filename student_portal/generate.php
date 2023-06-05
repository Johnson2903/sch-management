<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Generate a unique PIN code
function generatePIN($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $pin = '';
    for ($i = 0; $i < $length; $i++) {
        $pin .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $pin;
}

// Generate a scratch card
function generateScratchCard($pin) {
    // Design and print the scratch card
    $cardWidth = 300; // Set the width of the scratch card
    $cardHeight = 150; // Set the height of the scratch card

    // Create a new image canvas with the specified dimensions
    $cardImage = imagecreatetruecolor($cardWidth, $cardHeight);

    // Set the background color of the scratch card
    $backgroundColor = imagecolorallocate($cardImage, 255, 255, 255);
    imagefill($cardImage, 0, 0, $backgroundColor);

    // Add relevant branding, instructions, and graphics to the scratch card
    $textColor = imagecolorallocate($cardImage, 0, 0, 0);
    $brandingText = 'Scratch Card';
    $instructionsText = 'Scratch to reveal your PIN code';
    // $fontPath = 'https://example.com/fonts/font.ttf';

    // Add branding text to the scratch card
    // imagettftext($cardImage, 20, 0, 20, 40, $textColor, 'https://example.com/fonts/font.ttf', $brandingText);

    // Add instructions text to the scratch card
    // imagettftext($cardImage, 12, 0, 20, 80, $textColor, 'https://example.com/fonts/font.ttf', $instructionsText);

    // Generate and add the PIN code to the scratch card
    $pinCodeText = 'PIN: ' . $pin;
    // imagettftext($cardImage, 18, 0, 20, 120, $textColor, 'https://example.com/fonts/font.ttf', $pinCodeText);/

    // Apply the scratch-off material over the designated area
    $scratchOffColor = imagecolorallocate($cardImage, 200, 200, 200);
    $scratchAreaWidth = 200; // Set the width of the scratch-off area
    $scratchAreaHeight = 60; // Set the height of the scratch-off area
    $scratchAreaX = 20; // Set the X position of the scratch-off area
    $scratchAreaY = 100; // Set the Y position of the scratch-off area
    imagefilledrectangle($cardImage, $scratchAreaX, $scratchAreaY, $scratchAreaX + $scratchAreaWidth, $scratchAreaY + $scratchAreaHeight, $scratchOffColor);

    // Save the scratch card image to a file
   
    $filePath = 'card/scratch_card.png'; // Modify this with your desired file path and name

    imagepng($cardImage, $filePath);
    // imagedestroy($cardImage);
    echo '<img src="' . $filePath . '" alt="Scratch Card">';


    // Return the file path of the scratch card image
    return $filePath;

}


// Generate and store a scratch card with a unique PIN code
function createScratchCard() {
    $pin = generatePIN(); // Generate a unique PIN code

    // Insert the PIN code into the database
include "../engine/database.php";

    // $conn = mysqli_connect("localhost", "username", "password", "database_name");
    $sql = "INSERT INTO scratch_cards (pin_code, is_used) VALUES ('$pin', 0)";
    if (mysqli_query($conn, $sql)) {
        $scratchCard = generateScratchCard($pin); // Generate the scratch card
        echo "Scratch card created successfully!";
        // Return or display the scratch card as needed
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}

// Example usage
createScratchCard();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Scratch Card Example</title>
  <style>
    .scratch-card {
      position: relative;
      width: 400px;
      height: 200px;
      background-color: #ddd;
      border-radius: 10px;
      overflow: hidden;
    }
    
    .scratch-card .scratch-overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: #999;
      opacity: 0.8;
      cursor: pointer;
    }
    
    .scratch-card .scratch-text {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      font-size: 24px;
      font-weight: bold;
      color: #000;
    }
  </style>
</head>
<body>
  <div class="scratch-card">
    <div class="scratch-overlay"></div>
    <div class="scratch-text"><?php echo $pin?></div>
  </div>
</body>
</html>
