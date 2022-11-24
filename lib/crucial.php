<?php
class CrucialXML {
  public function encode($obj) {
    return xmlrpc_encode($obj);
  }
  public function decode($obj) {
    return xmlrpc_decode($obj);
  }
}
class CrucialJSON {
  public function encode($obj) {
    return json_encode($obj);
  }
  public function decode($obj) {
    return json_decode($obj);
  }
}
class CrucialSQL {
  private $conn = null;
  public function connect($host, $user, $password, $database) {
    $this->conn = mysqli_connect($host, $user, $password, $database);
    if ($this->conn->connect_errno) {
      throw new Exception("CrucialSQL Connection Error: " . $this->conn->connect_error);
    }
    return $this->conn;
  }
  public function prepared($sql, $data) {
    $conn = $this->conn;
    if (!$conn) {
      throw new Exception("CrucialSQL MySQL error! No connection!");
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);
    return $stmt->get_result();
  }
  public function escape($str) {
    $conn = $this->conn;
    if (!$conn) {
      throw new Exception("CrucialSQL MySQL error! No connection!");
    }
    return mysqli_real_escape_string($conn, $str);
  }
  public function evaluate($sql) {
    trigger_error("CrucialSQL MySQL warning: CrucialSQL->evaluate may result in unexpected results and is not recommended because it makes SQL injection easier. Use @ before using the function to suppress.");
    $conn = $this->conn;
    if (!$conn) {
      throw new Exception("CrucialSQL MySQL error! No connection!");
    }
    return $conn->query($sql);
  }
}
class CrucialCURL {
  public function curl_fetch($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }
  public function curl_fetch_custom($url, $ua = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0') {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }
  public function curl_fetch_custom_cookie($url, $ua = 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0', $jarDir = 'jar/') {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT, $ua);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($curl, CURLOPT_COOKIEFILE, $jar . md5($url) . '.txt');
    curl_setopt($curl, CURLOPT_COOKIEJAR, $jar . md5($url) . '.txt');
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }
}
class CrucialHTTP {
  public function fetch($url) {
    return file_get_contents($url);
  }
  public function fetch_cache($url, $cachetime = 86400) {
    $cache_file = 'cache/' . md5($url);
    if (file_exists($cache_file)) {
        i f(time() - filemtime($cache_file) > $cachetime) {
            $cache = file_get_contents($url);
            file_put_contents($cache_file, $cache);
        } else {
            $cache = file_get_contents($cache_file);
        }
    } else {
        $cache = file_get_contents($url);
    }
    return $cache;
  }
}
