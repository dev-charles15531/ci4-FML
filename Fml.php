<?php

namespace App\Libraries;

class Fml {

    private $path;
    private $file;
    private $size;
    private $name;
    private $extension;
    private $halfname;

    function __construct($path) {
        try {
            $this->path = $path;
            $this->file = new \CodeIgniter\Files\File($this->path);
            $this->size = $this->file->getSize();
            $this->name = $this->file->getFilename();
            $this->halfName = pathinfo($this->path, PATHINFO_FILENAME);
            $this->extension = $this->file->getExtension();    
        }
        catch(\Exception $e) {
        }
        
    }



    // Checking if the file is present in the specified path and generates an error if not found.
    function isPresent() : bool {
        try {
            $this->file = new \CodeIgniter\Files\File($this->path, "true");   
            return TRUE;    
        }
        catch(\Exception $e) {
            return FALSE;
        }
    }

    // Get the size of the file
    function calculateSize(string$measureBy="") : float {
        if(! empty($measureBy)) {
            if(strcmp($measureBy, "kilobyte") == 0) { 
                return round($this->size / 1024, 2, PHP_ROUND_HALF_UP);
            }
            elseif(strcmp($measureBy, "megabyte") == 0) {
                return round($this->size / 1048576, 2, PHP_ROUND_HALF_UP);
            }
            elseif(strcmp($measureBy, "gigabyte") == 0) {
                return round($this->size / (1048576*1024),2, PHP_ROUND_HALF_UP);
            }
            else {
                throw new \Exception("Invalid argument passed to the function getSize()");
            }
        }
        else {
            $this->size = $this->file->getSize(); 
            return $this->size;
        }
    }

    // Deletes the file
    function deleteFile() : bool {
        if(unlink($this->path)) {
            return true;
        }
        else {
            return false;
        }
    }

    // Get the name of the file
    function getName(bool $witExt = FALSE) : string {
        if($witExt = TRUE) {
            return $this->halfName;
        }
        return $this->name;
    }

    // Get the extension of the file
    function getExt() : string {
        return $this->extension;
    }

    // Get the path of the file without filename
    function getPath() : string {
        return $this->file->getPath();
    }

    // Set the name of the file
    function setName(string $name) : bool {
        $extension = $this->getExt();
        $newName = $name.'.'.$extension;
        $newPath = $this->file->move($this->getPath(), $newName);
        if($newPath) {
            $this->file = new \CodeIgniter\Files\File($newPath);
            $this->path = $newPath;
            $this->size = $this->file->getSize();
            $this->name = $this->file->getFilename();
            $this->halfName = pathinfo($this->path, PATHINFO_FILENAME);
            $this->extension = $this->file->getExtension();
            return TRUE;
        }
        else {
            return FALSE;
        }  
    }

    // Duplicates the file
    function duplicate() : bool {
        $name = $this->halfName;
        $extension = $this->getExt();
        $newName = $name.'1.'.$extension;
        return copy($this->path, $this->getPath().'/'.$newName);
    }
}
