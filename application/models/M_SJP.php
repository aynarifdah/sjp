<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_SJP extends CI_Model
{

  public function permohonanpengajuan($id)
  {
    $query = $this->db->query('SELECT * FROM `permohonan_penguajuan` WHERE `permohonan_pengajuan`.`id_pengajuan` = ' . $id . ' ');
    return $query->result_array();
  }

  public function sjp($id)
  {
    $query = $this->db->query('SELECT * FROM `sjp` WHERE `sjp`.`id_sjp` = ' . $id . ' ');
    return $query->result_array();
  }

  //  public function pejabat($id)
  //  {
  //   $query = $this->db->query('SELECT * FROM `pejabat` WHERE `pejabat`.`id_pejabat` = '.$id.' ');
  //   return $query->result_array();
  // }

  function select_all()
  {
    $results = array();
    $this->db->select('sjp.*,permohonan_pengajuan.*,puskesmas.*,rumah_sakit.*,diagnosa.*,penyakit.*,sp.*');
    $this->db->from('sjp');
    $this->db->join('permohonan_pengajuan', 'permohonan_pengajuan.id_pengajuan = sjp.id_pengajuan', 'left');
    $this->db->join('puskesmas', 'sjp.id_puskesmas = puskesmas.id_puskesmas', 'left');
    $this->db->join('rumah_sakit', 'rumah_sakit.id_rumah_sakit = sjp.id_rumah_sakit', 'left');
    $this->db->join('diagnosa', 'diagnosa.id_sjp = sjp.id_sjp', 'left');
    $this->db->join('penyakit', 'diagnosa.id_penyakit = penyakit.id_penyakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = permohonan_pengajuan.id_status_pengajuan', 'left');

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $results = $query->result();
    }
    return $results;
  }

  function select_pengajuan_sjp()
  {

    $this->db->select('pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan ,rs.nama_rumah_sakit as nm_rs, js.nama_jenis');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    $this->db->join('jenis_sjp js', 'sjp.jenis_sjp = js.id_jenissjp', 'left');
    $this->db->where('pp.id_status_pengajuan =', 4);
    $query = $this->db->get()->result_array();
    return $query;
  }
  function select_persetujuan_sjp_kayankesru()
  {

    $this->db->select('pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan ,rs.nama_rumah_sakit as nm_rs, js.nama_jenis');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    $this->db->join('jenis_sjp js', 'sjp.jenis_sjp = js.id_jenissjp', 'left');
    $this->db->where('pp.id_status_pengajuan =', 5);
    $query = $this->db->get()->result_array();
    return $query;
  }

  function getSinglePengajuan($id_sjp, $id_pengajuan){
    $this->db->select('*');
    $this->db->from('permohonan_pengajuan');
    $this->db->join('sjp', 'sjp.id_pengajuan = permohonan_pengajuan.id_pengajuan');
    $this->db->where_in('permohonan_pengajuan.id_pengajuan', $id_pengajuan, 'permohonan_pengajuan.id_sjp', $id_sjp);
    // $this->db->where('id_sjp', $id_sjp);
    // $this->db->group_by('permohonan_pengajuan.id_pengajuan');
    $query = $this->db->get()->result_array();
    return $query;
  }

  function getSingleSjpRs($id_pengajuan) {
      $this->db->select('*');
      $this->db->from('sjp');
      $this->db->join('permohonan_pengajuan', 'permohonan_pengajuan.id_pengajuan = sjp.id_pengajuan');
      $this->db->where('permohonan_pengajuan.id_pengajuan', $id_pengajuan);

      $query = $this->db->get()->result_array();
      return $query;
  }

  function getSingleSjpRsNamaFile($id_pengajuan, $file) {
      $this->db->select('*');
      $this->db->from('sjp');
      $this->db->join('permohonan_pengajuan', 'permohonan_pengajuan.id_pengajuan = sjp.id_pengajuan');
      $this->db->where('permohonan_pengajuan.id_pengajuan', $id_pengajuan);
      $this->db->where('sjp.namafile', $file);

      $query = $this->db->get()->result_array();
      return $query;
  }

  function getSingleSjpRsFileResume($id_pengajuan, $file) {
      $this->db->select('*');
      $this->db->from('sjp');
      $this->db->join('permohonan_pengajuan', 'permohonan_pengajuan.id_pengajuan = sjp.id_pengajuan');
      $this->db->where('permohonan_pengajuan.id_pengajuan', $id_pengajuan);
      $this->db->where('sjp.file_resume', $file);

      $query = $this->db->get()->result_array();
      return $query;
  }

  function getSingleSjpRsOtherFiles($id_pengajuan, $file) {
      $this->db->select('*');
      $this->db->from('sjp');
      $this->db->join('permohonan_pengajuan', 'permohonan_pengajuan.id_pengajuan = sjp.id_pengajuan');
      $this->db->where('permohonan_pengajuan.id_pengajuan', $id_pengajuan);
      $this->db->where('sjp.other_files', $file);

      $query = $this->db->get()->result_array();
      return $query;
  }

  function select_disetujui_sjp()
  {

    $this->db->select('pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan ,rs.nama_rumah_sakit as nm_rs, js.nama_jenis');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    $this->db->join('jenis_sjp js', 'sjp.jenis_sjp = js.id_jenissjp', 'left');
    $this->db->where('pp.id_status_pengajuan =', 6);
    $query = $this->db->get()->result_array();
    return $query;
  }

  function select_all_new($id_puskesmas, $id_jenissjp)
  {
    $results = array();
    $this->db->select('sjp.*, rumah_sakit.nama_rumah_sakit as nm_rs, permohonan_pengajuan.*,puskesmas.*,rumah_sakit.*,status_pengajuan.*');
    $this->db->from('sjp');
    $this->db->where('jenis_sjp !=', $id_jenissjp);
    $this->db->where('id_status_pengajuan', '2');
    $this->db->where('sjp.id_puskesmas', $id_puskesmas);
    // $this->db->where('status_survey','belum disurvey');
    $this->db->join('permohonan_pengajuan', 'permohonan_pengajuan.id_pengajuan = sjp.id_pengajuan', 'left');
    $this->db->join('puskesmas', 'sjp.id_puskesmas = puskesmas.id_puskesmas', 'left');
    $this->db->join('rumah_sakit', 'rumah_sakit.id_rumah_sakit = sjp.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan', 'permohonan_pengajuan.id_status_pengajuan = status_pengajuan.id_statuspengajuan');
    $this->db->order_by('tanggal_pengajuan', 'desc');
    // $this->db->join('diagnosa','diagnosa.id_sjp = sjp.id_sjp', 'left');
    // $this->db->join('penyakit','diagnosa.id_penyakit = penyakit.id_penyakit', 'left');

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $results = $query->result();
    }
    return $results;
  }
  function select_all_new_dinsos($id_jenissjp, $id_statuspengajuan)
  {
    $this->db->select('rs.nama_rumah_sakit as nm_rs, pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    // $this->db->where('pp.id_status_pengajuan =', 4);
    $this->db->where('id_status_pengajuan =', $id_statuspengajuan);
    $this->db->where('jenis_sjp =', $id_jenissjp);
    $this->db->order_by('pp.tanggal_pengajuan', 'desc');
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function getpersetujuandatasjp($id_puskesmas, $id_jenissjp)
  {
    $results = array();
    // $wherestatus = array(2, )
    $this->db->select('sjp.*, rumah_sakit.nama_rumah_sakit as nm_rs, permohonan_pengajuan.*,puskesmas.*,rumah_sakit.*,status_pengajuan.*');
    $this->db->from('sjp');
    $this->db->where('jenis_sjp !=', $id_jenissjp);
    $this->db->where('id_status_pengajuan', '6');
    $this->db->where('sjp.id_puskesmas', $id_puskesmas);
    // $this->db->where('status_survey','belum disurvey');

    $this->db->join('permohonan_pengajuan', 'permohonan_pengajuan.id_pengajuan = sjp.id_pengajuan', 'left');
    $this->db->join('puskesmas', 'sjp.id_puskesmas = puskesmas.id_puskesmas', 'left');
    $this->db->join('rumah_sakit', 'rumah_sakit.id_rumah_sakit = sjp.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan', 'permohonan_pengajuan.id_status_pengajuan = status_pengajuan.id_statuspengajuan');
    $this->db->order_by('tanggal_pengajuan', 'desc');
    // $this->db->join('diagnosa','diagnosa.id_sjp = sjp.id_sjp', 'left');
    // $this->db->join('penyakit','diagnosa.id_penyakit = penyakit.id_penyakit', 'left');

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $results = $query->result();
    }
    return $results;
  }
  function getpersetujuandatasjp_dinsos($id_jenissjp, $id_statuspengajuan)
  {
    $this->db->select('rs.nama_rumah_sakit as nm_rs, pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    // $this->db->where('pp.id_status_pengajuan =', 4);
    $this->db->where('status_pengajuan =', $id_statuspengajuan);
    $this->db->where('jenis_sjp =', $id_jenissjp);
    $this->db->order_by('pp.tanggal_pengajuan', 'desc');
    $query = $this->db->get()->result_array();
    return $query;
  }

  function select_all_survey()
  {
    $results = array();
    $this->db->select('sjp.*,permohonan_pengajuan.*,puskesmas.*,rumah_sakit.*');
    $this->db->from('sjp');
    // $this->db->where('status_klaim','Baru');
    // $this->db->where('status_survey','sudah disurvey');
    $this->db->join('permohonan_pengajuan', 'permohonan_pengajuan.id_pengajuan = sjp.id_pengajuan', 'left');
    $this->db->join('puskesmas', 'sjp.id_puskesmas = puskesmas.id_puskesmas', 'left');
    $this->db->join('rumah_sakit', 'rumah_sakit.id_rumah_sakit = sjp.id_rumah_sakit', 'left');
    // $this->db->join('diagnosa','diagnosa.id_sjp = sjp.id_sjp', 'left');
    // $this->db->join('penyakit','diagnosa.id_penyakit = penyakit.id_penyakit', 'left');

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $results = $query->result();
    }
    return $results;
  }
  function variabel_survey()
  {
    $this->db->select('ceklist_survey, id_ceklist_survey, indeks as index_survey,bobot as bobot_survey');
    $this->db->from('ceklist_survey');
    $this->db->where('ceklist_survey.status', '1');
    $query = $this->db->get()->result();
    return $query;
  }

  function count_jawaban()
  {
    $this->db->select('count(jawaban) as total, id_sjp');
    $this->db->from('survey');
    $this->db->where('jawaban = ', 'Setuju');
    $this->db->group_by('id_sjp');
    $query = $this->db->get()->result_array();
    return $query;
  }
  function insert_survey($data)
  {
    $this->db->insert('survey', $data);
  }


  function update_survey_sjp($data, $id_sjp)
  {
    $this->db->where('id_sjp', $id_sjp);
    $this->db->update('sjp', $data);
  }

  function update_id_status_pengajuan($data, $id_pengajuan)
  {
    $this->db->where('id_pengajuan', $id_pengajuan);
    $this->db->update('permohonan_pengajuan', $data);
  }

  function select_all_by_id($id_sjp)
  {
    $results = array();
    $this->db->select('sjp.*,permohonan_pengajuan.*,puskesmas.*,rumah_sakit.*,sp.*, CONCAT(sjp.alamat, ",", " RT. ", sjp.rt, " RW. ", sjp.rw, " Kel. ", sjp.kd_kelurahan, " Kec. ", sjp.kd_kecamatan) AS alamatpasien, rumah_sakit.nama_rumah_sakit as nm_rs, sjp.jenis_kelamin as jkpasien, jenis_sjp.nama_jenis, kelas_rawat.nama_kelas');
    $this->db->from('sjp');
    $this->db->where('sjp.id_sjp', $id_sjp);
    $this->db->join('permohonan_pengajuan', 'permohonan_pengajuan.id_pengajuan = sjp.id_pengajuan', 'left');
    $this->db->join('puskesmas', 'sjp.id_puskesmas = puskesmas.id_puskesmas', 'left');
    $this->db->join('kelas_rawat', 'sjp.kelas_rawat = kelas_rawat.id_kelas', 'left');
    $this->db->join('jenis_sjp', 'sjp.jenis_sjp = jenis_sjp.id_jenissjp', 'left');
    $this->db->join('rumah_sakit', 'rumah_sakit.id_rumah_sakit = sjp.id_rumah_sakit', 'left');
    //   $this->db->join('diagnosa','diagnosa.id_sjp = sjp.id_sjp');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = permohonan_pengajuan.id_status_pengajuan', 'left');
    // $this->db->join('diagnosa','diagnosa.id_sjp = sjp.id_sjp', 'left');
    // $this->db->join('penyakit','diagnosa.id_penyakit = penyakit.id_penyakit', 'left');

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $results = $query->result();
    }
    return $results;
  }
  function detail_cetak($id_sjp)
  {
    $results = array();
    $this->db->select('sjp.*,permohonan_pengajuan.*,puskesmas.*,rumah_sakit.*,sp.*, CONCAT(sjp.alamat, ",", " RT. ", sjp.rt, " RW. ", sjp.rw, " Kel. ", sjp.kd_kelurahan, " Kec. ", sjp.kd_kecamatan) AS alamatpasien, rumah_sakit.nama_rumah_sakit as nm_rs, sjp.jenis_kelamin as jkpasien, jenis_sjp.nama_jenis, kelas_rawat.nama_kelas');
    $this->db->from('sjp');
    $this->db->where('sjp.id_sjp', $id_sjp);
    $this->db->join('permohonan_pengajuan', 'permohonan_pengajuan.id_pengajuan = sjp.id_pengajuan', 'left');
    $this->db->join('puskesmas', 'sjp.id_puskesmas = puskesmas.id_puskesmas', 'left');
    $this->db->join('kelas_rawat', 'sjp.kelas_rawat = kelas_rawat.id_kelas', 'left');
    $this->db->join('jenis_sjp', 'sjp.jenis_sjp = jenis_sjp.id_jenissjp', 'left');
    $this->db->join('rumah_sakit', 'rumah_sakit.id_rumah_sakit = sjp.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = permohonan_pengajuan.id_status_pengajuan', 'left');
    // $this->db->join('diagnosa','diagnosa.id_sjp = sjp.id_sjp', 'left');
    // $this->db->join('d_penyakit','diagnosa.id_penyakit = d_penyakit.id_penyakit', 'left');

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $results = $query->result();
    }
    return $results;
  }
  function select_pengajuansjp_dinkes($id_sjp)
  {
    $results = array();
    $this->db->select('sjp.*,permohonan_pengajuan.*,puskesmas.*,rumah_sakit.*');
    $this->db->from('sjp');
    $this->db->where('sjp.id_sjp', $id_sjp);
    $this->db->join('permohonan_pengajuan', 'permohonan_pengajuan.id_pengajuan = sjp.id_pengajuan', 'left');
    $this->db->join('puskesmas', 'sjp.id_puskesmas = puskesmas.id_puskesmas', 'left');
    $this->db->join('rumah_sakit', 'rumah_sakit.id_rumah_sakit = sjp.id_rumah_sakit', 'left');
    // $this->db->join('diagnosa','diagnosa.id_sjp = sjp.id_sjp', 'left');
    // $this->db->join('penyakit','diagnosa.id_penyakit = penyakit.id_penyakit', 'left');

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $results = $query->result();
    }
    return $results;
  }
  function select_survey_variable($id_sjp, $id_checklist)
  {
    $results = array();
    $this->db->select('*');
    $this->db->from('survey');
    $this->db->where('id_ceklist_survey', $id_checklist);
    $this->db->where('id_sjp', $id_sjp);

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $results = $query->result();
    }
    return $results;
  }

  function select_opsi_ceklist($id_opsi_ceklist = null)
  {
    $results = array();
    $this->db->select('*');
    $this->db->from('opsi_ceklist');
    if (!empty($id_opsi_ceklist)) {
      $this->db->where('id_opsi_ceklist', $id_opsi_ceklist);
    }

    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      $results = $query->result();
    }
    return $results;
  }
  public function getbobot($idopsi)
  {
    $this->db->select('bobot');
    $this->db->from('opsi_ceklist');
    $this->db->where('id_opsi_ceklist', $idopsi);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->bobot;
    } else {
      return "0";
    }
  }


  public function id_pengajuan()
  {

    $this->db->select('id_pengajuan');
    $this->db->from('permohonan_pengajuan');
    $this->db->order_by("id_pengajuan", "desc");
    $this->db->limit(1);
    $query = $this->db->get();

    return $query->result_array();
  }

  public function id_sjp()
  {

    $this->db->select('id_sjp');
    $this->db->from('sjp');
    $this->db->order_by("id_sjp", "desc");
    $this->db->limit(1);
    $query = $this->db->get();

    return $query->result_array();
  }

  // TEST DIAGNOSA
  public function testDiagnosa($id_sjp)
  {
    $this->db->distinct();
    $this->db->select('d_penyakit.topik, diagnosa.id_diagnosa, diagnosa.id_penyakit, diagnosa.id_sjp');
    $this->db->from('d_penyakit');
    $this->db->join('diagnosa', 'diagnosa.id_penyakit = d_penyakit.namadiag', 'right');
    $this->db->where('diagnosa.id_sjp', $id_sjp);

    // $this->db->select('d.*, d_penyakit.topik, d_penyakit.namadiag');
    // $this->db->from('diagnosa d');
    // $this->db->join('d_penyakit', 'd.id_penyakit = d_penyakit.topik', 'left');
    // $this->db->where('d.id_sjp', $id_sjp);

    $query = $this->db->get()->result_array();
    return $query;
  }
  // TEST DIAGNOSA

  public function diagnosa()
  {
    $this->db->distinct();
    $this->db->select('topik');
    $this->db->from('d_penyakit');
    // $this->db->group_by('kecamatan, kelurahan');
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function diagnosa2($kd_topik = null)
  {
    $this->db->select('key_penyakit,kd_diag,namadiag,kd_topik,topik');
    $this->db->from('d_penyakit');
    if (!empty($kd_topik)) {
      $this->db->where('topik', $kd_topik);
    }
    $this->db->limit(10);

    // $this->db->group_by('kecamatan, kelurahan');
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function diagnosatag($search)
  {
    $this->db->select('namadiag as text');
    $this->db->from('d_penyakit');
    if (!empty($search)) {
      $this->db->like('namadiag', $search);
    }
    $this->db->group_by('namadiag');

    $query = $this->db->get()->result_array();
    return $query;
  }

  public function rumahsakit()
  {
    $this->db->select('id_rumah_sakit,nama_rumah_sakit');
    $this->db->from('rumah_sakit');
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function kelas_rawat()
  {
    $this->db->select('*');
    $this->db->from('kelas_rawat');
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function jenisjaminan()
  {
    $this->db->select('*');
    $this->db->from('jenis_sjp');
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function jkn()
  {
    $this->db->select('*');
    $this->db->from('jkn');
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function dokumen_persyaratan()
  {
    $this->db->select('id_persyaratan,nama_persyaratan');
    $this->db->from('persyaratan');
    $this->db->where('id_jenis_izin = ', 1);
    //$this->db->where('id_jenis_sjp =', 3);
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function wilayah($param, $KecId = null)
  {
    $this->db->select('kecamatan, kelurahan, kd_kecamatan, kd_kelurahan, jenis');
    $this->db->from('d_wilayah');
    $this->db->where('jenis', $param);
    $this->db->group_by('kecamatan');
    if (!empty($KecId)) {
      $this->db->where('kecamatan', $KecId);
    }
    // $this->db->group_by('kecamatan, kelurahan');
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function wilayah_kelurahan($param, $KecId = null)
  {
    $this->db->select('kecamatan, kelurahan, kd_kecamatan, kd_kelurahan, jenis');
    $this->db->from('d_wilayah');
    $this->db->where('jenis', $param);
    if (!empty($KecId)) {
      $this->db->where('kecamatan', $KecId);
    }
    // $this->db->group_by('kecamatan, kelurahan');
    $query = $this->db->get()->result_array();
    return $query;
  }

  // public function getDokumenGambar()
  // {
  //   $this->db->select('attachment.id_attachment as id_attach, attachment.attachment');
  //   $this->db->from('attachment');
  //   $this->db->jo
  // }

  //detail pengajuan sjp
  public function detail_permohonansjp($idsjp, $id_instansi, $id_join)
  {

    $this->db->select('rs.nama_rumah_sakit as nm_rs, pp.tanggal_pengajuan, pp.tanggal_selesai, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as emailpemohon, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan, nama_puskesmas, sk.*, js.nama_jenis, kelas_rawat.nama_kelas, sjp.id_rumah_sakit, diagnosa.id_penyakit as penyakit');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('puskesmas pus', 'sjp.id_puskesmas = pus.id_puskesmas', 'left');
    $this->db->join('kelas_rawat', 'sjp.kelas_rawat = kelas_rawat.id_kelas', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    $this->db->join('status_klaim sk', 'sk.id_statusklaim = sjp.status_klaim', 'left');
    $this->db->join('jenis_sjp js', 'sjp.jenis_sjp = js.id_jenissjp', 'left');
    $this->db->join('diagnosa', 'diagnosa.id_sjp = sjp.id_sjp', 'left');
    // $this->db->join('attachment', 'attachment.id_pengajuan = sjp.id_pengajuan', 'left');
    // $this->db->join('penyakit', 'diagnosa.id_penyakit = penyakit.id_penyakit', 'left');

    // $this->db->where('pp.id_status_pengajuan =', 4);
    // if (!empty($id_puskesmas)) {
    //   $this->db->where('sjp.id_puskesmas =', $id_puskesmas);
    // }
    // $this->db->limit(1);
    if ($id_instansi == 2) {
      $this->db->where('sjp.id_rumah_sakit', $id_join);
    }
    $this->db->limit(1);
    $this->db->where('sjp.id_sjp', $idsjp);
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function detail_permohonansjp_anjungan($idsjp, $id_puskesmas = null)
  {

    $this->db->select('rs.nama_rumah_sakit as nm_rs, pp.tanggal_pengajuan, pp.tanggal_selesai, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as emailpemohon, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan, nama_puskesmas, sk.*, js.nama_jenis');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('puskesmas pus', 'sjp.id_puskesmas = pus.id_puskesmas', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    $this->db->join('status_klaim sk', 'sk.id_statusklaim = sjp.status_klaim', 'left');
    $this->db->join('jenis_sjp js', 'sjp.jenis_sjp = js.id_jenissjp', 'left');

    // $this->db->where('pp.id_status_pengajuan =', 4);
    // if (!empty($id_puskesmas)) {
    //   $this->db->where('sjp.id_puskesmas =', $id_puskesmas);
    // }
    $this->db->where('sjp.id_sjp', $idsjp);
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function ceknikk($nik)
  {
    $this->db->select('rs.nama_rumah_sakit as nm_rs, pp.tanggal_pengajuan, pp.tanggal_selesai, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as emailpemohon, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan, nama_puskesmas, sk.*, js.nama_jenis, kelas_rawat.id_kelas, js.id_jenissjp, sjp.id_rumah_sakit, sjp.kelas_rawat');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('puskesmas pus', 'sjp.id_puskesmas = pus.id_puskesmas', 'left');
    $this->db->join('kelas_rawat', 'sjp.kelas_rawat = kelas_rawat.id_kelas', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    $this->db->join('status_klaim sk', 'sk.id_statusklaim = sjp.status_klaim', 'left');
    $this->db->join('jenis_sjp js', 'sjp.jenis_sjp = js.id_jenissjp', 'left');
    // $this->db->join('diagnosa','diagnosa.id_sjp = sjp.id_sjp', 'left');
    // $this->db->join('attachment','attachment.id_pengajuan = sjp.id_pengajuan', 'left');
    // $this->db->join('penyakit','diagnosa.id_penyakit = penyakit.id_penyakit', 'left');

    $this->db->where('nik', $nik);
    $query = $this->db->get()->result_array();
    return $query;
  }

  // public function getdiag($nik){
  //   $this->db->select('diagnosa.*,d_penyakit.topik,d_penyakit.kd_topik');
  //   $this->db->from('d_penyakit');
  //   $this->db->join('diagnosa', 'diagnosa.id_penyakit = d_penyakit.namadiag', 'left');
  //   $this->db->join('sjp', 'sjp.id_sjp = diagnosa.id_sjp', 'left');

  //   $this->db->where('nik', $nik);
  //   $query = $this->db->get()->result_array();
  // return $query;
  // }
  // public function ceknikk($nik)
  // {
  //   $this->db->select('*');
  //   $this->db->from('sjp');
  //   $this->db->where('nik', $nik);
  //   $query = $this->db->get()->result_array();
  //   return $query;
  // }

  public function anggaran_pasien()
  {
    $this->db->select('*');
    $this->db->from('anggaran');
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function diagpasien($id_sjp = null)
  {
    $this->db->select('id_sjp, id_penyakit as namadiag, penyakit');

    $this->db->from('diagnosa');
    if (!empty($id_sjp)) {
      $this->db->where('diagnosa.id_sjp', $id_sjp);
    }
    $query = $this->db->get()->result_array();
    return $query;
  }


  public function riwayatsjpasien($id_sjp)
  {
    $this->db->select('pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as emailpemohon, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan, nama_puskesmas, rs.nama_rumah_sakit as nama_rs');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('puskesmas pus', 'sjp.id_puskesmas = pus.id_puskesmas', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    $this->db->where('sjp.id_sjp = ', $id_sjp);
    // $this->db->where('sjp.nik = ', $nik);
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function view_daftarsurveysjp_pus()
  {
    $this->db->select('pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as emailpemohon, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan, nama_puskesmas');
    $this->db->from('permohonan pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('');
  }

  public function pejabat($id_pejabat)
  {
    $this->db->select('*');
    $this->db->from('pejabat');
    $this->db->where('id_pejabat', $id_pejabat);
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function view_pembayaran_klaimdinas($id_sjp = null)
  {
    $this->db->select('pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan, rs.nama_rumah_sakit as nm_rs');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    // $this->db->where('pp.id_status_pengajuan =', 4);
    if (!empty($id_sjp)) {
      $this->db->where_in('id_sjp', $id_sjp);
    }
    $this->db->where('id_status_pengajuan', 6);
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function gethasilsurvey($id_sjp, $id_puskesmas = null)
  {
    $this->db->select('jawaban');
    $this->db->from('survey');
    if (!empty($id_sjp)) {
      $this->db->where('id_sjp', $id_sjp);
    }
    if (!empty($id_puskesmas)) {
      $this->db->where('id_puskesmas', $id_puskesmas);
    }
    $query = $this->db->get()->result_array();
    return $query;
  }
  public function kethasilsurvey($id_sjp)
  {
    $this->db->select('ceklist_survey.ceklist_survey, opsi_ceklist.keterangan');
    $this->db->from('survey');
    $this->db->join('ceklist_survey', 'ceklist_survey.id_ceklist_survey = survey.id_ceklist_survey', 'left');
    $this->db->join('opsi_ceklist', 'opsi_ceklist.id_opsi_ceklist = survey.id_opsi_ceklist', 'left');

    // if (!empty($id_puskesmas)) {
    //   $this->db->where('id_puskesmas', $id_puskesmas);
    // }
    if (!empty($id_sjp)) {
      $this->db->where('id_sjp', $id_sjp);
    }
    $query = $this->db->get()->result_array();
    return $query;
  }

  // TEST 17-02-2021
  public function getForUpdateFile($id_pengajuan)
  {
    $this->db->select('attachment.attachment, persyaratan.id_persyaratan, persyaratan.nama_persyaratan');
    $this->db->from('persyaratan');
    $this->db->join('attachment', 'attachment.id_persyaratan = persyaratan.id_persyaratan', 'left');
    $this->db->where('id_pengajuan ', $id_pengajuan);
    // $this->db->where('id_jenis_izin', $id_jenis_izin);
    $query = $this->db->get()->result_array();
    return $query;
  }
  // TEST 17-02-2021


  public function getdokumenpersyaratan($id_pengajuan, $id_jenis_izin)
  {
    $this->db->select('*');
    $this->db->from('attachment');
    $this->db->where('id_pengajuan ', $id_pengajuan);
    $this->db->where('id_jenis_izin', $id_jenis_izin);
    // $this->db->where('id_persyaratan', $id_persyaratan);
    // $this->db->where('id_persyaratan !=', 4);
    $query = $this->db->get()->result_array();
    return $query;
  }
  
  public function getSingledokumenpersyaratan($id_pengajuan, $id_persyaratan)
  {
    $this->db->select('*');
    $this->db->from('attachment');
    $this->db->where('id_pengajuan ', $id_pengajuan);
    // $this->db->where('id_jenis_izin', $id_jenis_izin);
    $this->db->where('id_persyaratan', $id_persyaratan);
    // $this->db->where('id_persyaratan !=', 4);
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function input_nominal_pembiayaan($data, $id_sjp)
  {
    $this->db->where('id_sjp', $id_sjp);
    $this->db->update('sjp', $data);
    return ($this->db->affected_rows() > 0);
  }
  public function input_feedback($data, $id_sjp)
  {
    $this->db->where('id_sjp', $id_sjp);
    $this->db->update('sjp', $data);
    return ($this->db->affected_rows() > 0);
  }


  // ////////////////////////////////////////////////////////////////////////////////////////////////////
  // MAHDI - (Maaf, biar gampang kebaca)
  // ////////////////////////////////////////////////////////////////////////////////////////////////////

  public function tahun()
  {
    $this->db->select('year(tanggal_surat) as tahun');
    $this->db->distinct();
    $this->db->from('sjp');
    $this->db->where('tanggal_surat !=', Null);
    $query = $this->db->get()->result_array();
    return $query;
  }

  // Tidak dipakai karena database bulannya kurang
  public function bulan()
  {
    $this->db->select('MONTH(tanggal_surat) as bulan');
    $this->db->distinct();
    $this->db->from('sjp');
    // $this->db->group_by('kecamatan, kelurahan');
    $query = $this->db->get()->result_array();
    return $query;
  }



  public function anggaran($bulan = Null, $tahun = Null, $kecamatan = Null, $kelurahan = Null)
  {
    $this->db->select('nominal_anggaran');
    $this->db->from('anggaran');

    if (!empty($bulan)) {
      $this->db->where('MONTH(tanggal)', date("m", strtotime(str_replace('/', '-', $bulan))));
    }
    if (!empty($tahun)) {
      $this->db->where('YEAR(tanggal)', date("Y", strtotime($tahun)));
    }
    // Data Belum Ada di table
    // if (!empty($kecamatan)) {
    //   $this->db->where('kecamatan', date("Y", strtotime($kecamatan)));
    // }
    // if (!empty($kelurahan)) {
    //   $this->db->where('kelurahan', date("Y", strtotime($kelurahan)));
    // }

    $query = $this->db->get()->result_array();
    return $query;
  }

  public function nominal_pembiayaan($bulan = Null, $tahun = Null, $kecamatan = Null, $kelurahan = Null)
  {
    $this->db->select('SUM(sjp.nominal_pembiayaan) as nominal');
    $this->db->from('sjp');
    $this->db->join('permohonan_pengajuan pp', 'pp.id_pengajuan = sjp.id_pengajuan', 'left');

    if (!empty($bulan) or !empty($tahun) or !empty($kecamatan) or !empty($kelurahan)) {
      if (!empty($bulan)) {
        $this->db->where('MONTH(pp.tanggal_pengajuan)', date("m", strtotime(str_replace('/', '-', $bulan))));
      }
      if (!empty($tahun)) {
        $this->db->where('YEAR(pp.tanggal_pengajuan)', date("Y", strtotime($tahun)));
      }
      if (!empty($kecamatan)) {
        $this->db->where('sjp.kd_kecamatan', $kecamatan);
      }
      if (!empty($kelurahan)) {
        $this->db->where('sjp.kd_kelurahan', $kelurahan);
      }
    }

    $query = $this->db->get();
    return $query->result_array();
  }

  public function total_pasien($bulan = Null, $tahun = Null, $kecamatan = Null, $kelurahan = Null)
  {
    $this->db->select('sjp.nama_pasien, pp.tanggal_pengajuan');
    $this->db->from('sjp');
    $this->db->join('permohonan_pengajuan pp', 'pp.id_pengajuan = sjp.id_pengajuan', 'left');
    $this->db->join('puskesmas ps', 'ps.id_puskesmas = sjp.id_puskesmas', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    
    if ($this->session->userdata('instansi') == 3){
      $this->db->where('ps.id_puskesmas =', $this->session->userdata('id_join'));
    }

    if ($this->session->userdata('instansi') == 2) {
      $this->db->where('rs.id_rumah_sakit =', $this->session->userdata('id_join'));
    }
    if (!empty($bulan) or !empty($tahun) or !empty($kecamatan) or !empty($kelurahan)) {
      if (!empty($bulan)) {
        $this->db->where('MONTH(pp.tanggal_pengajuan)', date("m", strtotime(str_replace('/', '-', $bulan))));
      }
      if (!empty($tahun)) {
        $this->db->where('YEAR(pp.tanggal_pengajuan)', date("Y", strtotime($tahun)));
      }
      if (!empty($kecamatan)) {
        $this->db->where('sjp.kd_kecamatan', $kecamatan);
      }
      if (!empty($kelurahan)) {
        $this->db->where('sjp.kd_kelurahan', $kelurahan);
      }
    }

    $query = $this->db->get()->num_rows();
    return $query;
  }

  public function distribusi($bulan = Null, $tahun = Null, $kecamatan = Null, $kelurahan = Null, $pilih = 0)
  {
    // Pilih all = Null, pilih 1 = Ten, pilih 2 = five
    // echo date("m", strtotime(str_replace('/', '-', $bulan)));die;
    $this->db->select('rs.nama_rumah_sakit rs, count(sjp.id_rumah_sakit) as jumlah');
    $this->db->from('`rumah_sakit` rs');
    $this->db->join('sjp', 'rs.id_rumah_sakit = sjp.id_rumah_sakit', 'left');
    $this->db->join('permohonan_pengajuan pp', 'pp.id_pengajuan = sjp.id_pengajuan', 'left');
    $this->db->join('puskesmas ps', 'ps.id_puskesmas = sjp.id_puskesmas', 'left');

    $this->db->group_by("rs.nama_rumah_sakit");

    if ($this->session->userdata('instansi') == 3){
      $this->db->where('ps.id_puskesmas =', $this->session->userdata('id_join'));
    }

    if ($this->session->userdata('instansi') == 2) {
      $this->db->where('rs.id_rumah_sakit =', $this->session->userdata('id_join'));
    }
    
    if (!empty($bulan) or !empty($tahun) or !empty($kecamatan) or !empty($kelurahan)) {
      if (!empty($bulan)) {
        $this->db->where('MONTH(pp.tanggal_pengajuan)', date("m", strtotime(str_replace('/', '-', $bulan))));
      }
      if (!empty($tahun)) {
        $this->db->where('YEAR(pp.tanggal_pengajuan)', date("Y", strtotime($tahun)));
      }
      if (!empty($kecamatan)) {
        $this->db->where('sjp.kd_kecamatan', $kecamatan);
      }
      if (!empty($kelurahan)) {
        $this->db->where('sjp.kd_kelurahan', $kelurahan);
      }
    }


    if ($pilih != '0') {
      $this->db->order_by("jumlah", "DESC");
      if ($pilih == '1') {
        $this->db->limit(10);
      } else if ($pilih == '2') {
        $this->db->limit(5);
      }
    } else {
      $this->db->order_by("RAND()");
    }

    $query = $this->db->get()->result_array();
    // print_r($query);die;
    $result = [];
    foreach ($query as $res) {
      $result[] = [$res["rs"], (int)$res["jumlah"]];
    }
    // $result[] = $query;
    // print_r($result);die;
    // $query = $this->toArrayChart($query);
    return $result;
  }

  public function jumlah_sjp($bulan = Null, $tahun = Null, $kecamatan = Null, $kelurahan = Null)
  {

    $this->db->select('sp.status_pengajuan nama, count(pp.id_status_pengajuan) as jumlah');
    $this->db->from('`status_pengajuan` sp');
    $this->db->join('permohonan_pengajuan pp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    // $this->db->join('permohonan_pengajuan pp', 'pp.id_pengajuan = sjp.id_pengajuan', 'left');
    $this->db->join('puskesmas ps', 'ps.id_puskesmas = sjp.id_puskesmas', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');

    $this->db->group_by("sp.status_pengajuan");
    if (!empty($bulan)) {
      $this->db->where('MONTH(pp.tanggal_pengajuan)', date("m", strtotime(str_replace('/', '-', $bulan))));
    }
    if (!empty($tahun)) {
      $this->db->where('YEAR(pp.tanggal_pengajuan)', date("Y", strtotime($tahun)));
    }
    if (!empty($kecamatan)) {
      $this->db->where('sjp.kd_kecamatan', $kecamatan);
    }
    if (!empty($kelurahan)) {
      $this->db->where('sjp.kd_kelurahan', $kelurahan);
    }

    if ($this->session->userdata('instansi') == 3){
      $this->db->where('ps.id_puskesmas =', $this->session->userdata('id_join'));
    }
    if ($this->session->userdata('instansi') == 2) {
      $this->db->where('rs.id_rumah_sakit =', $this->session->userdata('id_join'));
    }
    return $this->db->get()->result_array();
  }

  public function jumlah_kunjungan_bulan($bulan = Null, $tahun = Null, $kecamatan = Null, $kelurahan = Null)
  {
    $tahun  = ($tahun == Null) ? date("Y") : $tahun;
    // var_dump($tahun);die;
    $query = "SELECT rs.nama_rumah_sakit rs,
              (SELECT COUNT(MONTH(pp.tanggal_pengajuan)) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 1 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY rs.nama_rumah_sakit) as januari,
                (SELECT COUNT(MONTH(pp.tanggal_pengajuan)) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 2 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY rs.nama_rumah_sakit) as februari,
                (SELECT COUNT(MONTH(pp.tanggal_pengajuan)) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 3 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY rs.nama_rumah_sakit) as maret,
                (SELECT COUNT(MONTH(pp.tanggal_pengajuan)) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 4 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY rs.nama_rumah_sakit) as april,
                (SELECT COUNT(MONTH(pp.tanggal_pengajuan)) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 5 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY rs.nama_rumah_sakit) as mei,
                (SELECT COUNT(MONTH(pp.tanggal_pengajuan)) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 6 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY rs.nama_rumah_sakit) as juni,
                (SELECT COUNT(MONTH(pp.tanggal_pengajuan)) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 7 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY rs.nama_rumah_sakit) as juli,
                (SELECT COUNT(MONTH(pp.tanggal_pengajuan)) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 8 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY rs.nama_rumah_sakit) as agustus,
                (SELECT COUNT(MONTH(pp.tanggal_pengajuan)) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 9 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY rs.nama_rumah_sakit) as september,
                (SELECT COUNT(MONTH(pp.tanggal_pengajuan)) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 10 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY rs.nama_rumah_sakit) as oktober,
                (SELECT COUNT(MONTH(pp.tanggal_pengajuan)) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 11 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY rs.nama_rumah_sakit) as november,
                (SELECT COUNT(MONTH(pp.tanggal_pengajuan)) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 12 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY rs.nama_rumah_sakit) as desember
              FROM sjp
            left join permohonan_pengajuan pp ON pp.id_pengajuan = sjp.id_pengajuan
            left join rumah_sakit rs ON rs.id_rumah_sakit = sjp.id_rumah_sakit";

    if (!empty($kecamatan)) {
      $query .= " WHERE ";
      if (!empty($kecamatan)) {
        $query .= "sjp.kd_kecamatan = '" . $kecamatan . "'";
        if (!empty($kelurahan)) {
          $query .= " AND sjp.kd_kelurahan = '" . $kelurahan . "'";
        }
      }
    }

    $query .= " GROUP BY rs.nama_rumah_sakit";

    $hasil = $this->db->query($query)->result_array();
    // var_dump($hasil);die;

    $januari  = isset($hasil[0]["januari"]) ? (int)$hasil[0]["januari"]  : 0;
    $februari = isset($hasil[0]["februari"]) ? (int)$hasil[0]["februari"] : 0;
    $maret    = isset($hasil[0]["maret"])   ? (int)$hasil[0]["maret"]    : 0;
    $april    = isset($hasil[0]["april"])   ? (int)$hasil[0]["april"]    : 0;
    $mei      = isset($hasil[0]["mei"])     ? (int)$hasil[0]["mei"]      : 0;
    $juni     = isset($hasil[0]["juni"])    ? (int)$hasil[0]["juni"]     : 0;
    $juli     = isset($hasil[0]["juli"])    ? (int)$hasil[0]["juli"]     : 0;
    $agustus  = isset($hasil[0]["agustus"]) ? (int)$hasil[0]["agustus"]  : 0;
    $september = isset($hasil[0]["september"]) ? (int)$hasil[0]["september"] : 0;
    $oktober  = isset($hasil[0]["oktober"]) ? (int)$hasil[0]["oktober"]  : 0;
    $november = isset($hasil[0]["november"]) ? (int)$hasil[0]["november"] : 0;
    $desember = isset($hasil[0]["desember"]) ? (int)$hasil[0]["desember"] : 0;

    $string[] = ['Januari', $januari];
    $string[] = ['Februari', $februari];
    $string[] = ['Maret', $maret];
    $string[] = ['April', $april];
    $string[] = ['Mei', $mei];
    $string[] = ['Juni', $juni];
    $string[] = ['Juli', $juli];
    $string[] = ['Agustus', $agustus];
    $string[] = ['September', $september];
    $string[] = ['Oktober', $oktober];
    $string[] = ['November', $november];
    $string[] = ['Desember', $desember];


    // var_dump($string);die;

    return $string;
  }

  public function trend_pasien($bulan = Null, $tahun = Null, $kecamatan = Null, $kelurahan = Null)
  {
    $tahun_now  = ($tahun == Null) ? date("Y") : $tahun;
    $tahun_min[0] = $tahun_now;
    $tahun_min[1] = $tahun_now - 1;
    $tahun_min[2] = $tahun_now - 2;
    $tahun_min[3] = $tahun_now - 3;
    $tahun_min[4] = $tahun_now - 4;

    for ($i = 0; $i <= 4; $i++) {
      // echo $tahun_min[$i];
      // $string = "SELECT sjp.nama_pasien, pp.tanggal_pengajuan, rs.nama_rumah_sakit rs, count(*) as jumlah
      //           FROM `sjp` 
      //           left join permohonan_pengajuan pp ON pp.id_pengajuan = sjp.id_pengajuan
      //           left join rumah_sakit rs ON rs.id_rumah_sakit = sjp.id_rumah_sakit
      //           WHERE YEAR(pp.tanggal_pengajuan) = " . $tahun_min[$i];
      $this->db->select('pp.tanggal_pengajuan, count(*) as jumlah');
      // $this->db->distinct();
      $this->db->from('sjp');
      $this->db->join('permohonan_pengajuan pp', 'pp.id_pengajuan = sjp.id_pengajuan', 'left');
      $this->db->join('rumah_sakit rs', 'rs.id_rumah_sakit = sjp.id_rumah_sakit', 'left');
      $this->db->join('puskesmas ps', 'ps.id_puskesmas = sjp.id_puskesmas', 'left');

      if ($this->session->userdata('instansi') == 3){
        $this->db->where('ps.id_puskesmas =', $this->session->userdata('id_join'));
      }
      
      // $this->db->group_by('pp.tanggal_pengajuan');

      if (!empty($bulan)) {
        $this->db->where('MONTH(pp.tanggal_pengajuan)', date("m", strtotime(str_replace('/', '-', $bulan))));
      }

      $test_tahun = date("Y", strtotime($tahun_min[3]));
      $this->db->where('YEAR(pp.tanggal_pengajuan)', $tahun_min[$i]);

      // var_dump("cek 1 : " . $test_tahun . "<br>");

      if (!empty($kecamatan)) {
        $this->db->where('sjp.kd_kecamatan', $kecamatan);
      }
      if (!empty($kelurahan)) {
        $this->db->where('sjp.kd_kelurahan', $kelurahan);
      }
      $query = $this->db->get()->result_array();

      // var_dump($query);

      $result[$i][] = (string)$tahun_min[$i];
      $result[$i][] = (int)$query[0]['jumlah'];

      // var_dump("cek 1 : " . $tahun_min[$i] . "  +++  ". $query[0]['jumlah'] ."<br>");
    }
    // var_dump($result);die;

    // var_dump(json_encode(array_reverse($result)));die;

    return json_encode(array_reverse($result));
  }

  public function jenis_rawat($bulan = Null, $tahun = Null, $kecamatan = Null, $kelurahan = Null)
  {
    $this->db->select('sjp.jenis_rawat, count(*) as jumlah');
    $this->db->from('sjp');
    $this->db->join('permohonan_pengajuan pp', 'pp.id_pengajuan = sjp.id_pengajuan', 'left');
    $this->db->join('puskesmas ps', 'ps.id_puskesmas = sjp.id_puskesmas', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');

    $this->db->group_by("jenis_rawat");

    if ($this->session->userdata('instansi') == 3){
      $this->db->where('ps.id_puskesmas =', $this->session->userdata('id_join'));
    }
    
    if ($this->session->userdata('instansi') == 2) {
      $this->db->where('rs.id_rumah_sakit =', $this->session->userdata('id_join'));
    }
    
    if (!empty($bulan) or !empty($tahun) or !empty($kecamatan) or !empty($kelurahan)) {
      if (!empty($bulan)) {
        $this->db->where('MONTH(pp.tanggal_pengajuan)', date("m", strtotime(str_replace('/', '-', $bulan))));
      }
      if (!empty($tahun)) {
        $this->db->where('YEAR(pp.tanggal_pengajuan)', date("Y", strtotime($tahun)));
      }
      if (!empty($kecamatan)) {
        $this->db->where('sjp.kd_kecamatan', $kecamatan);
      }
      if (!empty($kelurahan)) {
        $this->db->where('sjp.kd_kelurahan', $kelurahan);
      }
    }

    $query = $this->db->get()->result_array();
    return $query;
  }

  public function chartJenisRawat($bulan = Null, $tahun = Null, $kecamatan = Null, $kelurahan = Null)
  {
    $tahun  = ($tahun == Null) ? date("Y") : $tahun;
    $query = "SELECT sjp.jenis_rawat, count(*) as jumlah, 
            (SELECT count(sjp.jenis_rawat) as nama from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 1 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY sjp.jenis_rawat) as januari,
              (SELECT COUNT(sjp.jenis_rawat) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 2 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY sjp.jenis_rawat) as februari,
              (SELECT COUNT(sjp.jenis_rawat) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 3 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY sjp.jenis_rawat) as maret,
              (SELECT COUNT(sjp.jenis_rawat) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 4 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY sjp.jenis_rawat) as april,
              (SELECT COUNT(sjp.jenis_rawat) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 5 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY sjp.jenis_rawat) as mei,
              (SELECT COUNT(sjp.jenis_rawat) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 6 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY sjp.jenis_rawat) as juni,
              (SELECT COUNT(sjp.jenis_rawat) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 7 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY sjp.jenis_rawat) as juli,
              (SELECT COUNT(sjp.jenis_rawat) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 8 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY sjp.jenis_rawat) as agustus,
              (SELECT COUNT(sjp.jenis_rawat) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 9 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY sjp.jenis_rawat) as september,
              (SELECT COUNT(sjp.jenis_rawat) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 10 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY sjp.jenis_rawat) as oktober,
              (SELECT COUNT(sjp.jenis_rawat) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 11 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY sjp.jenis_rawat) as november,
              (SELECT COUNT(sjp.jenis_rawat) from permohonan_pengajuan pp WHERE MONTH(pp.tanggal_pengajuan) = 12 AND YEAR(pp.tanggal_pengajuan) = " . $tahun . " GROUP BY sjp.jenis_rawat) as desember
          from sjp
          left join permohonan_pengajuan pp ON pp.id_pengajuan = sjp.id_pengajuan";


    if (!empty($kecamatan)) {
      $query .= " WHERE ";
      if (!empty($kecamatan)) {
        $query .= "sjp.kd_kecamatan = '" . $kecamatan . "'";
        if (!empty($kelurahan)) {
          $query .= " AND sjp.kd_kelurahan = '" . $kelurahan . "'";
        }
      }
    }

    $query .= " GROUP BY jenis_rawat";

    $hasil = $this->db->query($query)->result_array();
    // var_dump($hasil);die;

    $string[] = "";
    for ($i = 0; $i < count($hasil); $i++) {
      $januari  = isset($hasil[$i]["januari"]) ? (int)$hasil[$i]["januari"]  : 0;
      $februari = isset($hasil[$i]["februari"]) ? (int)$hasil[$i]["februari"] : 0;
      $maret    = isset($hasil[$i]["maret"])   ? (int)$hasil[$i]["maret"]    : 0;
      $april    = isset($hasil[$i]["april"])   ? (int)$hasil[$i]["april"]    : 0;
      $mei      = isset($hasil[$i]["mei"])     ? (int)$hasil[$i]["mei"]      : 0;
      $juni     = isset($hasil[$i]["juni"])    ? (int)$hasil[$i]["juni"]     : 0;
      $juli     = isset($hasil[$i]["juli"])    ? (int)$hasil[$i]["juli"]     : 0;
      $agustus  = isset($hasil[$i]["agustus"]) ? (int)$hasil[$i]["agustus"]  : 0;
      $september = isset($hasil[$i]["september"]) ? (int)$hasil[$i]["september"] : 0;
      $oktober  = isset($hasil[$i]["oktober"]) ? (int)$hasil[$i]["oktober"]  : 0;
      $november = isset($hasil[$i]["november"]) ? (int)$hasil[$i]["november"] : 0;
      $desember = isset($hasil[$i]["desember"]) ? (int)$hasil[$i]["desember"] : 0;

      $data = [$januari, $februari, $maret, $april, $mei, $juni, $juli, $agustus, $september, $oktober, $november, $desember];

      $string[] =  ["name" => $hasil[$i]["jenis_rawat"], "data" => $data];
    }
    unset($string[0]);

    // var_dump($string);die;

    return $string;
  }

  private function toArrayChart($data)
  {
    $string = "[";
    $i = 0;
    $jumlah = count($data);
    foreach ($data as $rs) {
      if ($i + 1 == $jumlah) {
        $string .= "['" . $rs['rs'] . "'," . $rs['jumlah'] . "]";
      } else {
        $string .= "['" . $rs['rs'] . "'," . $rs['jumlah'] . "],";
      }
      $i++;
    }

    $string .= "]";
    return $string;
  }

  public function getAllUser($instansi, $cari = Null)
  {
    $this->db->select('user.*,level.nama_level, ins.nama_instansi,( case when user.id_instansi = 3 then (SELECT nama_puskesmas from puskesmas WHERE user.id_join = puskesmas.id_puskesmas) when user.id_instansi = 2 then (SELECT nama_rumah_sakit from rumah_sakit WHERE user.id_join = rumah_sakit.id_rumah_sakit ) end ) as nama_join');
    $this->db->from('user');
    $this->db->join('level', 'user.level = level.id_level', 'left');
    $this->db->join('instansi ins', 'ins.id_instansi  = user.id_instansi', 'left');

    $this->db->where('ins.id_instansi =', $instansi);

    if (!empty($cari)) {
      $this->db->like('CONCAT(user.nama,user.username)', $cari);
    }
    return $this->db->get()->result();
  }

  public function getAllUserDinkes($level = Null, $instansi = Null, $status = Null, $cari = Null)
  {
    $this->db->select('user.*, level.nama_level, ins.nama_instansi,( case when user.id_instansi = 3 then (SELECT nama_puskesmas from puskesmas WHERE user.id_join = puskesmas.id_puskesmas) when user.id_instansi = 2 then (SELECT nama_rumah_sakit from rumah_sakit WHERE user.id_join = rumah_sakit.id_rumah_sakit ) end ) as nama_join');
    $this->db->from('user');
    $this->db->join('level', 'user.level = level.id_level', 'left');
    $this->db->join('instansi ins', 'ins.id_instansi  = user.id_instansi', 'left');

    // $this->db->where('id_status_pengajuan =', 4);
    if (!empty($level)) {
      $this->db->where('level.id_level =', $level);
    }
    if (!empty($instansi)) {
      $this->db->where('ins.id_instansi =', $instansi);
    }
    // if (!empty($status)) {
    //   $this->db->where('pp.id_status_pengajuan =', $status);
    // }
    if (!empty($cari)) {
      $this->db->like('user.nama', $cari);
      $this->db->or_like('user.username', $cari);
      $this->db->or_like('level.nama_level', $cari);
      $this->db->or_like('ins.nama_instansi', $cari);
    }
    $query = $this->db->get()->result_array();
    return $query;
  }


  public function getUser($id)
  {
    $this->db->select("*");
    $this->db->from("user");
    $this->db->where("id_user =", $id);
    return $this->db->get()->result_array();
  }

  function select_pengajuan_sjp_all($id_status_pengajuan = null, $puskesmas = Null, $rumahsakit = Null, $status = Null, $cari = Null, $mulai = Null, $akhir = null)
  {
    $this->db->select('CONCAT(sjp.alamat, ",", " RT. ", sjp.rt, " RW. ", sjp.rw, " Kel. ", sjp.kd_kelurahan, " Kec. ", sjp.kd_kecamatan) AS alamatpasien, pp.tanggal_pengajuan, pp.tanggal_selesai, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan ,rs.nama_rumah_sakit as nm_rs');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    $this->db->join('puskesmas pus', 'sjp.id_puskesmas = pus.id_puskesmas', 'left');
    if (!empty($puskesmas)) {
      $this->db->where('pus.id_puskesmas =', $puskesmas);
    }
    if (!empty($mulai)) {
      $this->db->where('pp.tanggal_pengajuan >=', $mulai);
    }
    if (!empty($akhir)) {
      $this->db->where('pp.tanggal_pengajuan <=', $akhir);
    }
    if (!empty($rumahsakit)) {
      $this->db->where('rs.id_rumah_sakit =', $rumahsakit);
    }
    if (!empty($status)) {
      $this->db->where('pp.id_status_pengajuan =', $status);
    }
    if (!empty($cari)) {
      $this->db->like('CONCAT(pp.nama_pemohon,sjp.nama_pasien,sjp.nik,sjp.kd_kelurahan,sjp.kd_kecamatan,pp.email,pp.status_hubungan,sp.status_pengajuan,rs.nama_rumah_sakit,sjp.email,sjp.pekerjaan)', $cari);
      // $this->db->like('pp.nama_pemohon', $cari);
      // $this->db->or_like('sjp.nama_pasien', $cari);
      // $this->db->or_like('sjp.nik', $cari);
      // $this->db->or_like('sjp.kd_kelurahan', $cari);
      // $this->db->or_like('sjp.kd_kecamatan', $cari);
      // $this->db->or_like('pp.email', $cari);
      // $this->db->or_like('pp.status_hubungan', $cari);
      // $this->db->or_like('sp.status_pengajuan', $cari);
      // $this->db->or_like('rs.nama_rumah_sakit', $cari);
      // $this->db->or_like('sjp.email', $cari);
      // $this->db->or_like('sjp.pekerjaan', $cari);
    }
    //$this->db->where('pp.id_status_pengajuan !=', 4);
    $where = array(1, 2);
    $this->db->where_not_in('pp.id_status_pengajuan',  $where);
    // $this->db->where('id_puskesmas =', $id_puskesmas);
    $this->db->order_by('pp.tanggal_pengajuan', 'desc');
    $query = $this->db->get()->result_array();
    return $query;
  }

  function select_pengajuan_sjp_kelurahan($id_status_pengajuan = null, $kelurahan = Null, $rumahsakit = Null, $status = Null, $cari = Null, $mulai = Null)
  {
    $this->db->select('CONCAT(sjp.alamat, ",", " RT. ", sjp.rt, " RW. ", sjp.rw, " Kel. ", sjp.kd_kelurahan, " Kec. ", sjp.kd_kecamatan) AS alamatpasien, pp.tanggal_pengajuan, pp.tanggal_selesai, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan ,rs.nama_rumah_sakit as nm_rs');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    $this->db->join('puskesmas pus', 'sjp.id_puskesmas = pus.id_puskesmas', 'left');
    $this->db->join('kelurahan kel', 'sjp.kd_kelurahan = kel.kelurahan AND sjp.kd_kecamatan = kel.kecamatan', 'left');
    // $this->db->join('attachment att', 'att.id_pengajuan = pp.id_pengajuan AND att.attachment = ""  ', 'left');
    ;
    if (!empty($kelurahan)) {
      $this->db->where('kel.key_wilayah =', $kelurahan);
    }
    if (!empty($mulai)) {
      $this->db->like('pp.tanggal_pengajuan', $mulai);
    }
    if (!empty($rumahsakit)) {
      $this->db->where('rs.id_rumah_sakit =', $rumahsakit);
    }
    if (!empty($status)) {
      $this->db->where('pp.id_status_pengajuan =', $status);
    }
    if (!empty($cari)) {
      $this->db->like('CONCAT(pp.nama_pemohon,sjp.nama_pasien,sjp.nik,sjp.kd_kelurahan,sjp.kd_kecamatan,pp.email,pp.status_hubungan,sp.status_pengajuan,rs.nama_rumah_sakit,sjp.email,sjp.pekerjaan)', $cari);
      // $this->db->like('pp.nama_pemohon', $cari);
      // $this->db->or_like('sjp.nama_pasien', $cari);
      // $this->db->or_like('sjp.nik', $cari);
      // $this->db->or_like('sjp.kd_kelurahan', $cari);
      // $this->db->or_like('sjp.kd_kecamatan', $cari);
      // $this->db->or_like('pp.email', $cari);
      // $this->db->or_like('pp.status_hubungan', $cari);
      // $this->db->or_like('sp.status_pengajuan', $cari);
      // $this->db->or_like('rs.nama_rumah_sakit', $cari);
      // $this->db->or_like('sjp.email', $cari);
      // $this->db->or_like('sjp.pekerjaan', $cari);
    }
    //$this->db->where('pp.id_status_pengajuan !=', 4);
    if (!empty($kelurahan)) {

    }else{
      $where = array(1, 2);
      $this->db->where_not_in('pp.id_status_pengajuan',  $where);
    }
    // $this->db->where('id_puskesmas =', $id_puskesmas);
    $this->db->group_by('pp.id_pengajuan');
    $this->db->order_by('pp.tanggal_pengajuan', 'desc');
    $query = $this->db->get()->result_array();
    return $query;
  }



  public function getpersetujuansjpdinas($puskesmas = Null, $rumahsakit = Null, $status = Null, $cari = Null, $mulai = Null, $akhir = Null)
  {
    $this->db->select('CONCAT(sjp.alamat, ",", " RT. ", sjp.rt, " RW. ", sjp.rw, " Kel. ", sjp.kd_kelurahan, " Kec. ", sjp.kd_kecamatan) AS alamatpasien, pp.tanggal_pengajuan, pp.tanggal_selesai, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan ,rs.nama_rumah_sakit as nm_rs, js.nama_jenis');
    $this->db->from('sjp');
    $this->db->join('permohonan_pengajuan pp', 'pp.id_pengajuan = sjp.id_pengajuan', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan  = pp.id_status_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'rs.id_rumah_sakit = sjp.id_rumah_sakit', 'left');
    $this->db->join('puskesmas ps', 'ps.id_puskesmas = sjp.id_puskesmas', 'left');
    $this->db->join('jenis_sjp js', 'sjp.jenis_sjp = js.id_jenissjp', 'left');

    // $this->db->where('id_status_pengajuan =', 4);
    if (!empty($puskesmas)) {
      $this->db->where('ps.id_puskesmas =', $puskesmas);
    }
    if (!empty($mulai)) {
      $this->db->where('pp.tanggal_pengajuan >=', $mulai);
    }
    if (!empty($akhir)) {
      $this->db->where('pp.tanggal_pengajuan <=', $akhir);
    }
    if (!empty($rumahsakit)) {
      $this->db->where('rs.id_rumah_sakit =', $rumahsakit);
    }
    if (!empty($status)) {
      $this->db->where('pp.id_status_pengajuan =', $status);
    }
    if (!empty($cari)) {
      $this->db->like('CONCAT(pp.nama_pemohon,sjp.nama_pasien,sjp.nik,sjp.kd_kelurahan,sjp.kd_kecamatan,pp.email,pp.status_hubungan,sp.status_pengajuan,rs.nama_rumah_sakit,sjp.email,sjp.pekerjaan)', $cari);
      // $this->db->or_like('sjp.nama_pasien', $cari);
      // $this->db->or_like('sjp.nik', $cari);
      // $this->db->or_like('sjp.kd_kelurahan', $cari);
      // $this->db->or_like('sjp.kd_kecamatan', $cari);
      // $this->db->or_like('pp.email', $cari);
      // $this->db->or_like('pp.status_hubungan', $cari);
      // $this->db->or_like('sp.status_pengajuan', $cari);
      // $this->db->or_like('rs.nama_rumah_sakit', $cari);
      // $this->db->or_like('sjp.email', $cari);
      // $this->db->or_like('sjp.pekerjaan', $cari);
    }
    // TEST 18-02-2021
    $this->db->order_by('pp.tanggal_pengajuan', 'desc');
    // TEST 18-02-2021
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function getdatapengajuanklaim($id_status_klaim = null, $mulai = Null, $akhir = Null, $rs = Null, $status = Null, $jenis_rawat = null, $cari = Null)
  {
    $this->db->select('CONCAT(sjp.alamat, ",", " RT. ", sjp.rt, " RW. ", sjp.rw, " Kel. ", sjp.kd_kelurahan, " Kec. ", sjp.kd_kecamatan) AS alamatpasien, sjp.*, rs.nama_rumah_sakit as nm_rs, sk.*');
    $this->db->from('sjp');
    $this->db->join('status_klaim sk', 'sjp.status_klaim = sk.id_statusklaim', 'left');
    $this->db->join('rumah_sakit rs', 'rs.id_rumah_sakit = sjp.id_rumah_sakit', 'left');
    if (!empty($id_status_klaim)) {
      $this->db->where('sjp.status_klaim', $id_status_klaim);
    }
    if (!empty($mulai)) {
      $this->db->where('sjp.tanggal_tagihan >=', $mulai);
    }
    if (!empty($akhir)) {
      $this->db->where('sjp.tanggal_tagihan <=', $akhir);
    }
    if (!empty($rs)) {
      $this->db->where('rs.id_rumah_sakit =', $rs);
    }
    if (!empty($status)) {
      $this->db->where('sk.id_statusklaim =', $status);
    }
    if (!empty($jenis_rawat)) {
      $this->db->where('sjp.jenis_rawat =', $jenis_rawat);
    }
    if (!empty($cari)) {
      $this->db->like('CONCAT(sjp.nama_pasien,sjp.nik,sjp.kd_kelurahan,sk.nama_statusklaim,rs.nama_rumah_sakit,sjp.email,sjp.pekerjaan,sjp.nomor_tagihan)', $cari);
    }
    $this->db->where('status_klaim !=', null);
    // $this->db->where('status_edit', 1);
    $this->db->order_by('sjp.tanggal_tagihan', 'desc');

    $query = $this->db->get()->result_array();
    return $query;
  }

  //menampilkan data permohonan sjp di puskesmas
  public function view_permohonansjp_pus($id_jenissjp = null, $puskesmas = Null, $rumahsakit = Null, $status = Null, $cari = Null, $id_join = null, $id_instansi = null, $mulai = null)
  {
    $this->db->select('rs.nama_rumah_sakit as nm_rs, pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohion, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');

    // var_dump($id_join);die;

    if ($id_jenissjp) {
      $this->db->where('pp.id_status_pengajuan =', $id_jenissjp);
    }
    if ($id_instansi == 3) {
      $this->db->where('sjp.id_puskesmas =', $id_join);
    }
    if ($id_instansi == 2) {
      $this->db->where('rs.id_rumah_sakit =', $id_join);
    }
    if (!empty($mulai)) {
      $this->db->like('pp.tanggal_pengajuan', $mulai);
    }
    if (!empty($puskesmas)) {
      $this->db->where('id_puskesmas =', $puskesmas);
    }
    if (!empty($rumahsakit)) {
      $this->db->where('rs.id_rumah_sakit =', $rumahsakit);
    }
    if (!empty($status)) {
      $this->db->where('pp.id_status_pengajuan =', $status);
    }
    if (!empty($cari)) {
      $this->db->like('CONCAT(pp.nama_pemohon,sjp.nama_pasien,sjp.nik,sjp.kd_kelurahan,sjp.kd_kecamatan,pp.email,pp.status_hubungan,sp.status_pengajuan,rs.nama_rumah_sakit,rs.nama_rumah_sakit,sjp.email,sjp.pekerjaan)', $cari);
      // $this->db->like('pp.nama_pemohon', $cari);
      // $this->db->or_like('sjp.nama_pasien', $cari);
      // $this->db->or_like('sjp.nik', $cari);
      // $this->db->or_like('sjp.kd_kelurahan', $cari);
      // $this->db->or_like('sjp.kd_kecamatan', $cari);
      // $this->db->or_like('pp.email', $cari);
      // $this->db->or_like('pp.status_hubungan', $cari);
      // $this->db->or_like('sp.status_pengajuan', $cari);
      // $this->db->or_like('rs.nama_rumah_sakit', $cari);
      // $this->db->or_like('sjp.email', $cari);
      // $this->db->or_like('sjp.pekerjaan', $cari);
    }

    $this->db->where('jenis_sjp !=', $id_jenissjp);
    // $this->db->where('user !=', $id_join, $id_instansi);
    $this->db->order_by('pp.tanggal_pengajuan', 'desc');
    $query = $this->db->get()->result_array();
    return $query;
  }

   //menampilkan data permohonan sjp di kelurahan
  public function view_permohonansjp_kelurahan($id_jenissjp = null, $kelurahan = Null, $rumahsakit = Null, $status = Null, $cari = Null, $mulai = null)
  {
    $this->db->select('rs.nama_rumah_sakit as nm_rs, pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohion, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    $this->db->join('kelurahan kel', 'sjp.kd_kelurahan = kel.kelurahan AND sjp.kd_kecamatan = kel.kecamatan', 'left');
    if (!empty($kelurahan)) {
      $this->db->where('kel.key_wilayah =', $kelurahan);
    }
    // var_dump($id_join);die;

    if ($id_jenissjp) {
      $this->db->where('pp.id_status_pengajuan =', $id_jenissjp);
    }
    
    if (!empty($mulai)) {
      $this->db->like('pp.tanggal_pengajuan', $mulai);
    }
    // if (!empty($puskesmas)) {
    //   $this->db->where('id_puskesmas =', $puskesmas);
    // }
    if (!empty($rumahsakit)) {
      $this->db->where('rs.id_rumah_sakit =', $rumahsakit);
    }
    if (!empty($status)) {
      $this->db->where('pp.id_status_pengajuan =', $status);
    }
    if (!empty($cari)) {
      $this->db->like('CONCAT(pp.nama_pemohon,sjp.nama_pasien,sjp.nik,sjp.kd_kelurahan,sjp.kd_kecamatan,pp.email,pp.status_hubungan,sp.status_pengajuan,rs.nama_rumah_sakit,rs.nama_rumah_sakit,sjp.email,sjp.pekerjaan)', $cari);
      // $this->db->like('pp.nama_pemohon', $cari);
      // $this->db->or_like('sjp.nama_pasien', $cari);
      // $this->db->or_like('sjp.nik', $cari);
      // $this->db->or_like('sjp.kd_kelurahan', $cari);
      // $this->db->or_like('sjp.kd_kecamatan', $cari);
      // $this->db->or_like('pp.email', $cari);
      // $this->db->or_like('pp.status_hubungan', $cari);
      // $this->db->or_like('sp.status_pengajuan', $cari);
      // $this->db->or_like('rs.nama_rumah_sakit', $cari);
      // $this->db->or_like('sjp.email', $cari);
      // $this->db->or_like('sjp.pekerjaan', $cari);
    }

    $this->db->where('jenis_sjp !=', $id_jenissjp);
    // $this->db->where('user !=', $id_join, $id_instansi);
    $this->db->order_by('pp.tanggal_pengajuan', 'desc');
    $query = $this->db->get()->result_array();
    return $query;
  }


  public function view_permohonansjp_dinsos($id_jenissjp, $puskesmas = Null, $rs = Null, $status = Null, $cari = Null, $mulai = Null)
  {
    $this->db->select('rs.nama_rumah_sakit as nm_rs, pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    $this->db->join('puskesmas ps', 'ps.id_puskesmas = sjp.id_puskesmas', 'left');

    // $this->db->where('id_status_pengajuan =', 4);
    if (!empty($puskesmas)) {
      $this->db->where('ps.id_puskesmas =', $puskesmas);
    }
    if (!empty($mulai)) {
      $this->db->like('pp.tanggal_pengajuan', $mulai);
    }
    if (!empty($rs)) {
      $this->db->where('rs.id_rumah_sakit =', $rs);
    }
    if (!empty($status)) {
      $this->db->where('pp.id_status_pengajuan =', $status);
    }
    if (!empty($cari)) {
      $this->db->like('CONCAT(pp.nama_pemohon,sjp.nama_pasien,sjp.nik,sjp.kd_kelurahan,sjp.kd_kecamatan,pp.email,pp.status_hubungan,sp.status_pengajuan,rs.nama_rumah_sakit,sjp.email,sjp.pekerjaan)', $cari);
    }
    // $this->db->where('pp.id_status_pengajuan =', 4);
    // $this->db->where_not_in('jenis_sjp', [1,3,5,7]);
    if ($this->session->userdata('nama') != 'Dinsos View') {
      $this->db->where('jenis_sjp =', $id_jenissjp);
    }
    $this->db->order_by('pp.tanggal_pengajuan', 'desc');
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function getTanggalMenyetujui($id = Null)
  {
    $this->db->select("tanggal_surat, user.nama");
    $this->db->from('sjp');
    if (!empty($id)) {
      $this->db->where('id_sjp', $id);
    }
    $this->db->join('user', 'user.id_user = sjp.id_user_menyetujui', 'left');
    return $this->db->get()->result_array();
  }

  public function getRs($id = Null)
  {
    $this->db->select('id_rumah_sakit as id, nama_rumah_sakit as nama');
    $this->db->from('rumah_sakit');
    if (!empty($id)) {
      $this->db->where('id_rumah_sakit', $id);
    }
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function getPuskesmas($id = Null)
  {
    $this->db->select('id_puskesmas as id, nama_puskesmas as nama');
    $this->db->from('puskesmas');
    if (!empty($id)) {
      $this->db->where('id_puskesmas', $id);
    }
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function getKelurahan($id = Null)
  {
    $this->db->select('key_wilayah as id, kelurahan as nama');
    $this->db->from('kelurahan');
    if (!empty($id)) {
      $this->db->where('key_wilayah', $id);
    }
    $query = $this->db->get()->result_array();
    return $query;
  }

  // Contoh
  // public function view_permohonansjp_pus($id_jenissjp,$puskesmas=Null,$rumahsakit=Null, $status=Null, $cari=Null){
  //   $this->db->select('rs.nama_rumah_sakit as nm_rs, pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan');
  //   $this->db->from('permohonan_pengajuan pp');
  //   $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
  //   $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
  //   $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
  //   // $this->db->where('pp.id_status_pengajuan =', 4);

  //   if (!empty($puskesmas)) {
  //     $this->db->where('id_puskesmas =', $puskesmas);
  //   }
  //   if (!empty($rumahsakit)) {
  //     $this->db->where('rs.id_rumah_sakit =', $rumahsakit);
  //   }
  //   if (!empty($status)) {
  //     $this->db->where('pp.id_status_pengajuan =', $status);
  //   }
  //   if (!empty($cari)) {
  //     $this->db->like('CONCAT(pp.nama_pemohon,sjp.nama_pasien,sjp.nik,sjp.kd_kelurahan,sjp.kd_kecamatan,pp.email,pp.status_hubungan,sp.status_pengajuan,rs.nama_rumah_sakit,rs.nama_rumah_sakit,sjp.email,sjp.pekerjaan)', $cari);
  //   }
  // $this->db->where('jenis_sjp !=', $id_jenissjp);
  // $this->db->order_by('pp.tanggal_pengajuan', 'desc');
  // $query = $this->db->get()->result_array();
  // return $query;
  // }

  public function view_permohonanklaim_rs($id_sjp,$mulai = Null, $akhir = Null, $rs = Null, $status = Null, $cari = Null,  $id_instansi = null, $id_join = null )
  {
    $this->db->select('pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('status_klaim sk', 'sjp.status_klaim = sk.id_statusklaim', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    // echo $id_instansi;die;
    if ($id_instansi == 2) {
      $this->db->where('sjp.id_rumah_sakit', $id_join);
    }

    // $this->db->where('pp.id_status_pengajuan =', 4);
    if (!empty($id_sjp)) {
      $this->db->where_in('id_sjp', $id_sjp);
    }

    if (!empty($mulai)) {
      $this->db->like('pp.tanggal_pengajuan', $mulai);
      // $this->db->where('pp.tanggal_pengajuan', $mulai);
    }
    if (!empty($akhir)) {
      $this->db->where('pp.tanggal_pengajuan <=', $akhir);
    }
    if (!empty($rs)) {
      $this->db->where('rs.id_rumah_sakit =', $rs);
    }
    if (!empty($status)) {
      $this->db->where('sk.id_statusklaim =', $status);
    }
    if (!empty($cari)) {
      $this->db->like('CONCAT(pp.nama_pemohon)', $cari);
    }

    // $this->db->where('id_status_pengajuan', 6);
    // $this->db->where('tanggal_tagihan', null);
    // $this->db->where('status_klaim', null);
    // $this->db->where('status_edit', null);
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function editPermohonanPengajuan($id, $data)
  {
    $this->db->set($data);
    $this->db->where('id_pengajuan', $id);
    // $this->db->update('permohonan_pengajuan');
    if ($this->db->update('permohonan_pengajuan')) {
      return true;
    } else {
      return false;
    }
  }

  public function editSJP($id, $data)
  {
    $this->db->set($data);
    $this->db->where('id_sjp', $id);
    // $this->db->update('sjp');
    if ($this->db->update('sjp')) {
      return true;
    } else {
      return false;
    }
  }

  public function cekstatus($nik)
  {
    $this->db->select('rs.nama_rumah_sakit as nm_rs, pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan, pp.id_pengajuan');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    // $this->db->where('pp.id_status_pengajuan =', 4);

    $this->db->where('nik !=', '');
    $this->db->where('nik =', $nik);




    $this->db->order_by('pp.tanggal_pengajuan', 'desc');
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function getByPuskesmasId($puskesmas_id)
  {
    $this->db->select('id_puskesmas');
    $this->db->where('id_puskesmas', $puskesmas_id);
    $hasil = $this->db->get('puskesmas');
    $result = $hasil->result();
    return $result[0]->id_puskesmas;
  }


  function delete_pengajuan($id_pengajuan)
  {
    $this->db->where('id_pengajuan', $id_pengajuan);
    $this->db->delete('permohonan_pengajuan');
  }

  function delete_sjp($id_sjp)
  {
    $this->db->where('id_sjp', $id_sjp);
    $this->db->delete('sjp');
  }

  function delete_attachment($id_pengajuan)
  {
    $this->db->where('id_pengajuan', $id_pengajuan);
    $this->db->delete('attachment');
  }

  function delete_diagnosa($id_sjp)
  {
    $this->db->where('id_sjp', $id_sjp);
    $this->db->delete('diagnosa');
  }

  function delete_survey($id_sjp)
  {
    $this->db->where('id_sjp', $id_sjp);
    $this->db->delete('survey');
  }

  function getFiles($id = null)
  {
    if (!empty($id)) {
      $this->db->select('file_name');
      $this->db->from('files');
      $this->db->where('id=', $id);
      $query = $this->db->get()->row_array();
    } else {
      $this->db->select('*');
      $this->db->from('files');
      $query = $this->db->get()->result_array();
    }
    return $query;
  }

  public function datapasien($nik)
  {
    $this->db->select('pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as emailpemohon, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan, nama_puskesmas, rs.nama_rumah_sakit as nama_rs');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('puskesmas pus', 'sjp.id_puskesmas = pus.id_puskesmas', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    // $this->db->where('sjp.id_sjp = ', $id_sjp);
    $this->db->where('sjp.nik = ', $nik);
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function feedback_dinkes($id_sjp)
  {
    $this->db->select('feedback_dinkes');
    $this->db->from('sjp');
    $this->db->where('id_sjp = ', $id_sjp);
    $query = $this->db->get()->row_array();
    return $query;
  }

  public function parameter_waktu_pengajuan()
  {
    $this->db->select('*');
    $this->db->from('jam_pengajuan');
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function detail_waktu_pengajuan($id)
  {
    $this->db->select('*');
    $this->db->from('jam_pengajuan');
    $this->db->where('id', $id);

    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        foreach ($query->result_array() as $row) {
            $data[]=$row;
        }
        $query->free_result();
    } else {
        $data=null;
    }
    return $data;
  }

  public function parameter_waktu_survey()
  {
    $this->db->select('*');
    $this->db->from('jam_survey');
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function detail_waktu_survey($id)
  {
    $this->db->select('*');
    $this->db->from('jam_survey');
    $this->db->where('id', $id);

    $query = $this->db->get();
    if ($query->num_rows() > 0) {
        foreach ($query->result_array() as $row) {
            $data[]=$row;
        }
        $query->free_result();
    } else {
        $data=null;
    }
    return $data;
  }

  public function getnominal_pembiayaan($id_sjp)
  {
    $this->db->select('CONCAT(sjp.alamat, ",", " RT. ", sjp.rt, " RW. ", sjp.rw, " Kel. ", sjp.kd_kelurahan, " Kec. ", sjp.kd_kecamatan) AS alamatpasien, sjp.*, rs.nama_rumah_sakit as nm_rs, sk.*, , pp.tanggal_pengajuan, sp.status_pengajuan, pp.id_status_pengajuan');
    $this->db->from('sjp');
    $this->db->join('permohonan_pengajuan pp', 'pp.id_pengajuan = sjp.id_pengajuan', 'left');
    $this->db->join('status_klaim sk', 'sjp.status_klaim = sk.id_statusklaim', 'left');
    $this->db->join('rumah_sakit rs', 'rs.id_rumah_sakit = sjp.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left'); 

     // $this->db->where('pp.id_status_pengajuan =', 4);
    if (!empty($id_sjp)) {
      $this->db->where_in('id_sjp', $id_sjp);
    }

    $this->db->where('status_klaim !=', null);
    // $this->db->where('status_edit', 1);
    $this->db->order_by('sjp.tanggal_tagihan', 'desc');

    $query = $this->db->get()->result_array();
    return $query;
  }

  public function getKategoriPenerima($total)
  {
    $this->db->select('kategori');
    $this->db->from('kategori_penerima');
    $this->db->where('min_nilai <= ', $total);
    $this->db->where('max_nilai >= ', $total);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->row()->kategori;
    } else {
      return "Tidak Ditemukan";
    }
  }

  function select_ditolak_sjp()
  {

    $this->db->select('pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan ,rs.nama_rumah_sakit as nm_rs, js.nama_jenis');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    $this->db->join('jenis_sjp js', 'sjp.jenis_sjp = js.id_jenissjp', 'left');
    $this->db->where('pp.id_status_pengajuan =', 7);
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function getditolaksjpdinas($puskesmas = Null, $rumahsakit = Null, $status = Null, $cari = Null, $mulai = Null, $akhir = Null)
  {
    $this->db->select('CONCAT(sjp.alamat, ",", " RT. ", sjp.rt, " RW. ", sjp.rw, " Kel. ", sjp.kd_kelurahan, " Kec. ", sjp.kd_kecamatan) AS alamatpasien, pp.tanggal_pengajuan, pp.tanggal_selesai, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan ,rs.nama_rumah_sakit as nm_rs, js.nama_jenis');
    $this->db->from('sjp');
    $this->db->join('permohonan_pengajuan pp', 'pp.id_pengajuan = sjp.id_pengajuan', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan  = pp.id_status_pengajuan', 'left');
    $this->db->join('rumah_sakit rs', 'rs.id_rumah_sakit = sjp.id_rumah_sakit', 'left');
    $this->db->join('puskesmas ps', 'ps.id_puskesmas = sjp.id_puskesmas', 'left');
    $this->db->join('jenis_sjp js', 'sjp.jenis_sjp = js.id_jenissjp', 'left');

    // $this->db->where('id_status_pengajuan =', 4);
    if (!empty($puskesmas)) {
      $this->db->where('ps.id_puskesmas =', $puskesmas);
    }
    if (!empty($mulai)) {
      $this->db->where('pp.tanggal_pengajuan >=', $mulai);
    }
    if (!empty($akhir)) {
      $this->db->where('pp.tanggal_pengajuan <=', $akhir);
    }
    if (!empty($rumahsakit)) {
      $this->db->where('rs.id_rumah_sakit =', $rumahsakit);
    }
    if (!empty($status)) {
      $this->db->where('pp.id_status_pengajuan =', $status);
    }
    if (!empty($cari)) {
      $this->db->like('CONCAT(pp.nama_pemohon,sjp.nama_pasien,sjp.nik,sjp.kd_kelurahan,sjp.kd_kecamatan,pp.email,pp.status_hubungan,sp.status_pengajuan,rs.nama_rumah_sakit,sjp.email,sjp.pekerjaan)', $cari);
      // $this->db->or_like('sjp.nama_pasien', $cari);
      // $this->db->or_like('sjp.nik', $cari);
      // $this->db->or_like('sjp.kd_kelurahan', $cari);
      // $this->db->or_like('sjp.kd_kecamatan', $cari);
      // $this->db->or_like('pp.email', $cari);
      // $this->db->or_like('pp.status_hubungan', $cari);
      // $this->db->or_like('sp.status_pengajuan', $cari);
      // $this->db->or_like('rs.nama_rumah_sakit', $cari);
      // $this->db->or_like('sjp.email', $cari);
      // $this->db->or_like('sjp.pekerjaan', $cari);
    }
    // TEST 18-02-2021
    $this->db->order_by('pp.tanggal_pengajuan', 'desc');
    // TEST 18-02-2021
    $query = $this->db->get()->result_array();
    return $query;
  }

  public function getByKelurahanId($kelurahan_id)
  {
    $this->db->select('key_wilayah');
    $this->db->where('key_wilayah', $kelurahan_id);
    $hasil = $this->db->get('kelurahan');
    $result = $hasil->result();
    return $result[0]->key_wilayah;
  }

  public function getdatapengajuanklaim_puskesmas($id_status_klaim = null, $mulai = Null, $akhir = Null, $pkm = Null, $status = Null, $jenis_rawat = null, $cari = Null)
  {
    $this->db->select('CONCAT(sjp.alamat, ",", " RT. ", sjp.rt, " RW. ", sjp.rw, " Kel. ", sjp.kd_kelurahan, " Kec. ", sjp.kd_kecamatan) AS alamatpasien, sjp.*, rs.nama_rumah_sakit as nm_rs, sk.*');
    $this->db->from('sjp');
    $this->db->join('status_klaim sk', 'sjp.status_klaim = sk.id_statusklaim', 'left');
    $this->db->join('rumah_sakit rs', 'rs.id_rumah_sakit = sjp.id_rumah_sakit', 'left');
    if (!empty($id_status_klaim)) {
      $this->db->where('sjp.status_klaim', $id_status_klaim);
    }
    if (!empty($mulai)) {
      $this->db->where('sjp.tanggal_tagihan >=', $mulai);
    }
    if (!empty($akhir)) {
      $this->db->where('sjp.tanggal_tagihan <=', $akhir);
    }
    if (!empty($pkm)) {
      $this->db->where('sjp.id_puskesmas =', $pkm);
    }
    if (!empty($status)) {
      $this->db->where('sk.id_statusklaim =', $status);
    }
    if (!empty($jenis_rawat)) {
      $this->db->where('sjp.jenis_rawat =', $jenis_rawat);
    }
    if (!empty($cari)) {
      $this->db->like('CONCAT(sjp.nama_pasien,sjp.nik,sjp.kd_kelurahan,sk.nama_statusklaim,rs.nama_rumah_sakit,sjp.email,sjp.pekerjaan,sjp.nomor_tagihan)', $cari);
    }
    $this->db->where('status_klaim !=', null);
    // $this->db->where('status_edit', 1);
    $this->db->order_by('sjp.tanggal_tagihan', 'desc');

    $query = $this->db->get()->result_array();
    return $query;
  }

  public function view_permohonanklaim_pkm($mulai = Null, $akhir = Null, $pkm = Null, $status = Null, $cari = Null,  $id_instansi = null, $id_join = null, $id_sjp)
  {
    $this->db->select('pp.tanggal_pengajuan, pp.nama_pemohon, pp.jenis_kelamin as jkpemohon, pp.telepon as telpemohon, pp.whatsapp as wapemohon, pp.email as email, pp.alamat as alamatpemohon, pp.kd_kelurahan as kelpemohon, pp.kd_kecamatan as kecpemohon, pp.rt as rtpemohon, pp.rw as rwpemohon, pp.status_hubungan, pp.nama_pejabat_satu, pp.nip_pejabat_satu, sjp.*, sp.status_pengajuan, pp.id_status_pengajuan');
    $this->db->from('permohonan_pengajuan pp');
    $this->db->join('sjp', 'sjp.id_pengajuan = pp.id_pengajuan', 'left');
    $this->db->join('status_klaim sk', 'sjp.status_klaim = sk.id_statusklaim', 'left');
    $this->db->join('rumah_sakit rs', 'sjp.id_rumah_sakit = rs.id_rumah_sakit', 'left');
    $this->db->join('status_pengajuan sp', 'sp.id_statuspengajuan = pp.id_status_pengajuan', 'left');
    // echo $id_instansi;die;
    if ($id_instansi == 2) {
      $this->db->where('sjp.id_rumah_sakit', $id_join);
    }

    // $this->db->where('pp.id_status_pengajuan =', 4);
    if (!empty($id_sjp)) {
      $this->db->where_in('id_sjp', $id_sjp);
    }

    if (!empty($mulai)) {
      $this->db->like('pp.tanggal_pengajuan', $mulai);
      // $this->db->where('pp.tanggal_pengajuan', $mulai);
    }
    if (!empty($akhir)) {
      $this->db->where('pp.tanggal_pengajuan <=', $akhir);
    }
    if (!empty($pkm)) {
      $this->db->where('sjp.id_puskesmas =', $pkm);
    }
    if (!empty($status)) {
      $this->db->where('sk.id_statusklaim =', $status);
    }
    if (!empty($cari)) {
      $this->db->like('CONCAT(pp.nama_pemohon)', $cari);
    }

    $this->db->where('id_status_pengajuan', 6);
    // $this->db->where('tanggal_tagihan', null);
    $this->db->where('status_klaim', null);
    // $this->db->where('status_edit', 0);
    $query = $this->db->get()->result_array();
    return $query;
  }

  function cek_logTTE($id_sjp)
  {
    $this->db->select('*');
    $this->db->from('log_tte');
    $this->db->where('log_tte.id_sjp', $id_sjp);
    $this->db->where('log_tte.pesan', 'Berhasil');

    $query = $this->db->get()->row_array();
    return $query;
  }


}
