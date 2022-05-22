<?php
function base64_to_file($data, $path) {
    if (preg_match('/^data:image\/(\w+)(\+\w+)?;base64,/', $data, $type)) {
        $data = substr($data, strpos($data, ',') + 1);
        $type = strtolower($type[1]); // jpg, png, gif
    
        if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png', 'svg' ])) {
            throw new \Exception('invalid image type');
        }
        $data = str_replace( ' ', '+', $data );
        $data = base64_decode($data);
    
        if ($data === false) {
            throw new \Exception('base64_decode failed');
        }

        $hash = hash('sha256', $data);

        if ($hash === false) {
            throw new \Exception('sha256 hash failed');
        }
    } else {
        throw new \Exception('did not match data URI with image data');
    }

    if (!is_dir($path)) mkdir($path, 0755, true);
    
    file_put_contents("$path/$hash.$type", $data);
}

function base64_from_file($file) {
    $type = pathinfo($file, PATHINFO_EXTENSION);
    $type = ($type === 'svg') ? 'svg+xml' : $type;

    $data = file_get_contents($file);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    return $base64;
}

?>