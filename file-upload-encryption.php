// Define the directory where the uploaded file will be saved
$uploadDirectory = "images/";

// Get the name, temporary name, error, content type, and size of the uploaded file
$fileName = $_FILES['fileToUpload']['name'];
$tempFileName = $_FILES['fileToUpload']['tmp_name'];
$error = $_FILES['fileToUpload']['error'];
$fileContentType = $_FILES['fileToUpload']['type'];
$fileSize = $_FILES['fileToUpload']['size'];

// Check if the file was uploaded successfully
if($error==UPLOAD_ERR_OK){
  // Open the uploaded file in read mode and read the content
  $file = fopen($tempFileName,"r");
  $content = fread($file,filesize($tempFileName));

  // Encrypt the content using base64 encoding
  $encryptedContent = base64_encode($content);

  // Generate a unique name for the encrypted file
  $encryptedFileSaveName=$uploadDirectory.md5('file3').".c";

  // Open the encrypted file in write mode and save the encrypted content
  $encryptedFile = fopen($encryptedFileSaveName,'w');
  fwrite($encryptedFile,$encryptedContent);
  fclose($encryptedFile);

  // Print a success message if the file was uploaded and encrypted successfully
  print("File has been upload and encrypted successfully.");
}else{
  // Print an error message if there was an error during file upload
  print("Error while uploading......");
}
?>
