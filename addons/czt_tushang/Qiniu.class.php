<?php
use Qiniu\Auth;
use Qiniu\Processing\PersistentFop;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

function classLoader($class) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . '/' . $path . '.php';

    if (file_exists($file)) {
        require $file;
    }
}
spl_autoload_register('classLoader');
require __DIR__ . '/Qiniu/functions.php';

class Qiniu {

    private $config = null;
    private $auth   = null;

    public function __construct($config) {
        $this->config = $config;
        $this->auth   = new Auth($config['ak'], $config['sk']);
    }
    public function pfop($key, $fops, $notifyUrl = '') {
        $pfop           = new PersistentFop($this->auth, $this->config['bucket'], $this->config['pipeline'], $notifyUrl);
        list($id, $err) = $pfop->execute($key, $fops);
        if ($err !== null) {
            return false;
        } else {
            return $id;
        }
    }
    public function upload($key, $data, $ops = '', $notifyurl = '') {
        global $_W;
        $policy = array(
            'persistentOps'       => $ops,
            'persistentNotifyUrl' => $notifyurl,
            'persistentPipeline'  => $this->config['pipeline'],
        );
        $token             = $this->auth->uploadToken($this->config['bucket'], null, 3600, $policy);
        $uploadMgr         = new UploadManager();
        list($ret, $err) = $uploadMgr->put($token, $key, $data);
        if ($err !== null) {
            return $err;
        } else {
            return true;
        }
    }
    public function fetch($url, $key, $bucket) {
        $mgr             = new BucketManager($this->auth);
        list($ret, $err) = $mgr->fetch($url, ($bucket ?: $this->config['bucket']), $key);
        if ($err !== null) {
            return $err;
        } else {
            return true;
        }
    }
    public function delete($key) {
        $mgr             = new BucketManager($this->auth);
        list($ret, $err) = $mgr->delete($this->config['bucket'], $key);
        if ($err !== null) {
            return $err;
        } else {
            return true;
        }
    }
    public function batchDelete($keys) {
        $mgr             = new BucketManager($this->auth);
        $ops             = $mgr->buildBatchDelete($this->config['bucket'], $keys);
        list($ret, $err) = $mgr->batch($ops);
        if ($err !== null) {
            return $err;
        } else {
            return true;
        }
    }
}