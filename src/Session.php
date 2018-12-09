<?php

namespace Karamel\Session;
class Session
{
    private $fileName;
    private $sessionData;

    public function __construct($filename)
    {
        $this->fileName = $filename;
    }


    public function set($key, $value)
    {
        $data = $this->parseFile();
        $data[$key] = $value;
        $this->saveFile($data);
    }

    private function parseFile(): array
    {
        if ($this->sessionData == null)
            $this->sessionData = unserialize(file_get_contents(KM_SESSION_DIR . $this->fileName));
        return $this->sessionData;
    }

    private function saveFile($data)
    {
        return file_put_contents(KM_SESSSION_DIR . $this->fileName, serialize($data));
    }

    public function get($key, $default = null)
    {
        $data = $this->parseFile();
        if (!isset($data[$key]))
            return $default;
        return $data[$key];
    }

    public function delete($key)
    {
        $data = $this->parseFile();
        unset($data[$key]);
        $this->saveFile($data);
    }

    public function destroy()
    {
        @unlink(KM_SESSION_DIR . $this->fileName);
    }
}