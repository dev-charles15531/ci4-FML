# ci4-FML
Codeigniter 4 File Manipulation Library

## How To Use:
**The Fml.php file is to be cloned or copied into your codeigniter 4 app/Libraries folder.**
- In your controller class, the library should be imported using;
````php
use App\Libraries\Fml; // Import library
````
- An instance of the library is created using;
````php
$file = new Fml($path); // create an instance of Library
````
Where $path is the path to the file to work with in **string**

- The following methods are accessible with the instantiated class:
````php
$file->isPresent() : bool
// Checks if the file is present and returns a boolean value of true if the file is found and false on the contray.

$file->calculateSize() : string
// Returns in string, the file size in bytes.
// An optional argument of "kilobyte", "megabyte" or "gigabyte" can be passed to the method to return the file size in kilobyte, megabyte or gigabyte respectively.

$file->deleteFile() : bool
// Deletes the file and returns true on success and false on error.

$file->getName() : string
// Returns in string format, the name of the file without extension.
// An optional parameter of TRUE can be passed to the method to return the file name with its extension.

$file->getExt() : string
// Returns the extension of the file in string format.

$file->getPath() : string
// Returns the path to the file without file name.

$file->duplicate() : bool 
// Duplicates the file and returns the value of true on success and false on error.
// The duplicated file is given the name of the original file, with '1' appended at the end of the name.

$file->setName(string $newName) : bool
// Gives the file a new name supplied as an argument in string format to the method.
// Returns true on success and false on error.

````


##  License
**ci4-FML** is released under the [MIT License](https://github.com/dev-charles15531/ci4-FML/blob/main/LICENSE).

Created by **[Charles Paul](https://github.com/dev-charles15531)**
