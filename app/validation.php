<?php

class Input {

  public static function get($name) {
    if (isset($_POST[$name])) {
      return $_POST[$name];
    } elseif (isset($_GET[$name])) {
      return $_GET[$name];
    } elseif (isset($_REQUEST[$name])) {
      return $_REQUEST[$name];
    }
    else return false;
  }

  static public function empty($name) {
		if (is_array($name)) {
			// code...
		}else {
			if (!empty(trim(self::get($name)))) return true;
				else return false;
		}
	}

  public static function val($name, $var = null) {
    return (self::get($name)) ? self::get($name) : $var;
  }

  public static function ajax($name, $var = null) {
    return (self::get($name)) ? self::get($name) : $var;
  }

  public static function opt($name, $var1 = null, $var2 = null) {
    return (self::get($name)) ? $var1 : $var2;
  }

}

function getValue($value)
{
  if (isset($_POST[$value])) {
    return $_POST[$value];
  }elseif (isset($_GET[$value])) {
    return $_GET[$value];
  }
  return false;
}

function getRequest($name)
{
  if (isset($_REQUEST[$name])) {
    return $_REQUEST[$name];
  }
  return false;
}

function ifValue($value, $title)
{
  $title = '';
  if (!empty($value)) {
    return$value;
  }else {
    return $title;
  }
}

/*
 * $length/$value untuk menentukan banyak karakter random
 * $keyspace kumpulan angka dan hutuf untuk menentukan karakter random
 * $str untuk menghubungkan antara baris string
 * mb_strlen() function mengecek length pada string
 * random_int() melakukan pemberikan angka pada karakter random
**/
function token($value)
{
  $keyspace = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';
  $max = mb_strlen($keyspace, '8bit') - 1;
  for ($i = 0; $i < $value; ++$i) {
    $str .= $keyspace[random_int(0, $max)];
  }
  return $str;
}
function encode($string) {
  $hash = str_replace(['+','/','='], ['-','_',''], base64_encode($string));
  $start = substr($hash, 0, strlen($hash)/2);
  $end = substr($hash, strlen($hash)/2);
  $str = token(16).$start.token(16).$end.token(16);
  return $str;
}
function decode($string) {
  $data = substr($string, 16, -16);
  $awal = (strlen($data)-16)/2;
  $nilai = (is_double($awal)) ? substr($awal, 0, -2) : $awal ;
  $jumlah = (strlen($data)-16)%2;
  $start = substr($data, 0,$nilai);
  $end = substr($data ,strlen($data)-($nilai+$jumlah), $nilai+$jumlah);
  return base64_decode(str_replace(['-','_'],['+','/'], $start.$end));
}

function gender($val) {
	if ($val == 1) {
		return "Laki - Laki";
	}else {
		return "Perempuan";
	}
}
date_default_timezone_set('Asia/Jakarta');

function setDate($tgl){
		$tanggal = substr($tgl,8,2);
		$bulan = month(substr($tgl,5,2));
		$tahun = substr($tgl,0,4);
		return $tanggal.' '.$bulan.' '.$tahun;
}

function setDatetime($waktu){
	$tanggal = substr($waktu,8,2);
	$bulan = month(substr($waktu,5,2));
	$tahun = substr($waktu,0,4);
	$jam = substr($waktu, 11, 2);
	$menit = substr($waktu, 14, 2);
	$detik = substr($waktu, 17, 2);
	return $jam.':'.$menit.':'.$detik.' | '.$tanggal.' '.$bulan.' '.$tahun;
}
function setTime($waktu){
	$jam = substr($waktu, 11, 2);
	$menit = substr($waktu, 14, 2);
	$detik = substr($waktu, 17, 2);
	return $jam.':'.$menit.':'.$detik;
}

function runDate(){
	return date('Y-m-d');
}

function runTime(){
	return date('H:i-s');
}

function runDatetime(){
  return date('Y-m-d H:i-s');
}

/*
 * Date and Time
**/
function day($value) {
	if ($value == 1) {
		return "Senin";
	} elseif ($value == 2) {
		return "Selasa";
	} elseif ($value == 3) {
		return "Rabu";
	} elseif ($value == 4) {
		return "Kamis";
	} elseif ($value == 5) {
		return "Jum'at";
	} else {
		return "Sabtu";
	}
}
$hari = array(
 'Sunday' => 'Minggu',
 'Monday' => 'Senin',
 'Tuesday' => 'Selasa',
 'Wednesday' => 'Rabu',
 'Thursday' => 'Kamis',
 'Friday' => 'Jumat',
 'Saturday' => 'Sabtu'
);
function setDay($val) {
  global $hari;
  return $hari[date('l', strtotime($val))];
}
function setDayDate($val) {
  global $hari;
  return $hari[date('l', strtotime($val))].' - '.setDate($val);
}

function month($value) {
	if ($value == 1) {
		return "Januari";
	} elseif ($value == 2) {
		return "Februari";
	} elseif ($value == 3) {
		return "Maret";
	} elseif ($value == 4) {
		return "April";
	} elseif ($value == 5) {
		return "Mei";
	} elseif ($value == 6) {
		return "Juni";
	} elseif ($value == 7) {
		return "Juli";
	} elseif ($value == 8) {
		return "Agustus";
	} elseif ($value == 9) {
		return "September";
	} elseif ($value == 10) {
		return "Oktober";
	} elseif ($value == 11) {
		return "November";
	} else {
		return "Desamber";
	}
}

function kelas($val) {
  if ($val == 1) {
    echo "Kelas 10";
  } elseif ($val == 2) {
    echo "Kelas 11";
  } else {
    echo "Kelas 12";
  }
}

function level($val) {
  if ($val == 1) {
    echo "Administrator/Kurikulum";
  }elseif ($val == 2) {
    echo "Staf";
  }elseif ($val == 3) {
    echo "Guru";
  }else {
    echo "Proktor";
  }
}

function kateMapel($val) {
  if ($val == 1) {
    echo "Normatif";
  }elseif ($val == 2) {
    echo "Adaptif";
  }else {
    echo "Produktif";
  }
}
function kateSemes($val) {
  if ($val == 1 || $val == 3 || $val == 5) {
    echo "Ganjil";
  }else {
    echo "Genap";
  }
}
function kateSoal($val) {
  if ($val == 1) {
    echo "Objektif";
  }else {
    echo "Essay";
  }
}
function hasilJawab($val) {
  if ($val == 1) {
    echo "Benar";
  }elseif ($val == 2) {
    echo "Salah";
  }else {
    echo "Tidak Menjawab";
  }
}
