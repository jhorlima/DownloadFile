# DownloadFile
Class to help download files with try catch

Methods:

getFileInfo = @return SplFileInfo object 

setFile = @param $filePatch, @return this object

setNewName = @param $newName, [@param $haveExtension = true ( default ) - false to add extension of the original file], [@param $extension = null ( default ) - string to new extension, this parameter ignores the parameter $haveExtension ],  @return this object

setValidatorExtension = @param validExtensionslist, @return this object (optional)

download = @return file to download.

index.php is an example!
