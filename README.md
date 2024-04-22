# SFTP FILE UPLOAD USING CURL

$sendFilePath = "/path/simple.csv";
$sendFileName = "simple";

$ret = SftpService::uploadFile($sendFileName, $sendFilePath);
