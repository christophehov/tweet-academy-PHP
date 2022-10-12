<?php 

namespace App\Classes;

use App\Classes\Database;
use App\Model\User;
use App\Model\Register;

class View 
{    
    /**
     * render
     *
     * @param  mixed $path
     * @param  mixed $data
     * @return bool
     */
    public function render($path, $data = null): bool
    {
        try {
            if ($data) {
                extract($data);
            }
            require_once "../view/$path.php";
        } catch (\Exception $exception) {
            echo "Error View: " . $exception->getMessage();
        }
        return true;
    }
}