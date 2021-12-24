
<?php
require_once __DIR__.'/../../../../app/config.php';

$array = ['A', 'B', 'C', 'D', 'E'];
$kunci = $_REQUEST['kunci'][0];
$key = [];
$kelas = [1 => 10, 2 => 11, 3 => 12,];

for ($i=0; $i < count($_REQUEST['jawab']); $i++) {
  $a = $array[$i];
  if ($kunci == $a){$key[$i] = 1;}else{$key[$i] = 0;}
}

if (!empty($_FILES['file']['name'])) {
  $file->name('file')->error()->size('3mb')->images();
}

if ($db->table('bagian')->select('id_bagian')->where('kelas_bagian = ? AND id_mapel = ?', [$_REQUEST['kelas'], $_REQUEST['mapel']])->get()) {
  foreach ($db->table('bagian')->select('id_bagian')->where('kelas_bagian = ? AND id_mapel = ?', [$_REQUEST['kelas'], $_REQUEST['mapel']])->get() as $key => $id);
  foreach ($db->table('kelas')->select('id_kelas')->like('nama_kelas', '%'.$kelas[$_REQUEST['kelas']].'%')->get() as $key => $value) {
    if (is_null($db->table('bagian_kelas')->where('id_kelas = ? AND id_bagian = ?', [$value->id_kelas,  $id->id_bagian])->get())) {
      $db->table('bagian_kelas')->insert(['id_kelas' => $value->id_kelas, 'id_bagian' => $id->id_bagian]);
    }
  }
  $fields = [
    'text_soal' => Input::get('text'),
    'image_soal' => (!empty($_FILES['file'])) ? $file->link() : '',
    'id_bagian' => $id->id_bagian,
  ];
  $db->table('soal')->insert($fields);
  $id = $db->insert_id();
  for ($i=0; $i < count($_REQUEST['jawab']); $i++) {
    $db->table('jawaban')->insert(['text_jawaban' => $_REQUEST['jawab'][$i], 'kunci_jawaban' => $key[$i], 'id_soal' => $id]);
  }
  $msg->success('Soal berhasil tersimpan', '?soal=tambah');
}else {
  $db->table('bagian')->insert(['id_mapel' => $_REQUEST['mapel'], 'kelas_bagian' => $_REQUEST['kelas']]);
  $id = $db->insert_id();
  foreach ($db->table('kelas')->select('id_kelas')->like('nama_kelas', '%'.$kelas[$_REQUEST['kelas']].'%')->get() as $key => $value) {
    if (is_null($db->table('bagian_kelas')->where('id_kelas = ? AND id_bagian = ?', [$value->id_kelas,  $id])->get())) {
      $db->table('bagian_kelas')->insert(['id_kelas' => $value->id_kelas, 'id_bagian' => $id]);
    }
  }
  $fields = [
    'text_soal' => Input::get('text'),
    'image_soal' => (!empty($_FILES['file'])) ? $file->link() : '',
    'id_bagian' => $id,
  ];
  $db->table('soal')->insert($fields);
  $id = $db->insert_id();
  for ($i=0; $i < count($_REQUEST['jawab']); $i++) {
    $db->table('jawaban')->insert(['text_jawaban' => $_REQUEST['jawab'][$i], 'kunci_jawaban' => $key[$i], 'id_soal' => $id]);
  }
  $msg->success('Soal berhasil tersimpan', '?soal=tambah');
}
?>
