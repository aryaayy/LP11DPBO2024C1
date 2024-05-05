<?php


include("KontrakView.php");
include("presenter/ProsesPasien.php");

class TampilPasien implements KontrakView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampil()
	{
		$this->prosespasien->prosesDataPasien();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
			$no = $i + 1;
			$data .= '<tr>
			<td>' . $no . '</td>
			<td>' . $this->prosespasien->getNik($i) . '</td>
			<td>' . $this->prosespasien->getNama($i) . '</td>
			<td>' . $this->prosespasien->getTempat($i) . '</td>
			<td>' . $this->prosespasien->getTl($i) . '</td>
			<td>' . $this->prosespasien->getGender($i) . '</td>
			<td>' . $this->prosespasien->getEmail($i) . '</td>
			<td>' . $this->prosespasien->getTelp($i) . '</td>
			<td>
				<a href="edit.php?id='. $this->prosespasien->getId($i) .'" class="btn btn-warning">Edit</a>
				<a href="index.php?id='. $this->prosespasien->getId($i) .'" class="btn btn-danger">Delete</a>
			</td>';
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function add()
	{
		// $this->prosespasien->prosesDataPasien();

		$data = '<form action="create.php" method="post">
			<br><br><div class="card w-50 px-2">
		
			<label> NIK: </label>
			<input type="text" name="nik" class="form-control"> <br>
		
			<label> NAMA: </label>
			<input type="text" name="nama" class="form-control"> <br>
		
			<label> TEMPAT: </label>
			<input type="text" name="tempat" class="form-control"> <br>
		
			<label> TANGGAL LAHIR: </label>
			<input type="date" name="tl" class="form-control"> <br>
		
			<label> GENDER: </label>
				<select class="form-control" aria-label="Category" id="gender" name="gender" required>
					<option value="" selected disabled hidden>Pilih</option>
					<option value="Laki-laki">Laki-laki</option>
					<option value="Perempuan">Perempuan</option>
				</select> <br>
			
			<label> EMAIL: </label>
			<input type="text" name="email" class="form-control"> <br>
		
			<label> TELP: </label>
			<input type="text" name="telp" class="form-control"> <br>
		
			<button class="btn btn-success" type="submit" name="btn-add"> Submit </button><br>
			<a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>
		
			</div>
		</form>';
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin_form.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_FORM", $data);
		$this->tpl->replace("DATA_TITLE", "Tambah Pasien");

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function edit($id)
	{
		$this->prosespasien->isiForm($id);

		$data = '<form action="edit.php" method="post">
			<br><br><div class="card w-50 px-2">

			<input type="hidden" name="id" value="'. $this->prosespasien->getId() .'">
		
			<label> NIK: </label>
			<input type="text" name="nik" class="form-control" value="'. $this->prosespasien->getNik() .'"> <br>
		
			<label> NAMA: </label>
			<input type="text" name="nama" class="form-control" value="'. $this->prosespasien->getNama() .'"> <br>
		
			<label> TEMPAT: </label>
			<input type="text" name="tempat" class="form-control" value="'. $this->prosespasien->getTempat() .'"> <br>
		
			<label> TANGGAL LAHIR: </label>
			<input type="date" name="tl" class="form-control" value="'. $this->prosespasien->getTl() .'"> <br>
		
			<label> GENDER: </label>
				<select class="form-control" aria-label="Category" id="gender" name="gender" required>
					<option value="" selected disabled hidden>Pilih</option>
					<option value="Laki-laki" '. ($this->prosespasien->getGender() == "Laki-laki" ? 'selected' : '') .'>Laki-laki</option>
					<option value="Perempuan" '. ($this->prosespasien->getGender() == "Perempuan" ? 'selected' : '') .'>Perempuan</option>
				</select> <br>
			
			<label> EMAIL: </label>
			<input type="text" name="email" class="form-control" value="'. $this->prosespasien->getEmail() .'"> <br>
		
			<label> TELP: </label>
			<input type="text" name="telp" class="form-control" value="'. $this->prosespasien->getTelp() .'"> <br>
		
			<button class="btn btn-success" type="submit" name="btn-add"> Submit </button><br>
			<a class="btn btn-info" type="submit" name="cancel" href="index.php"> Cancel </a><br>
		
			</div>
		</form>';
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin_form.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_FORM", $data);
		$this->tpl->replace("DATA_TITLE", "Edit Pasien");

		// Menampilkan ke layar
		$this->tpl->write();
	}
}
