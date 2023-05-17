<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Mahasiswa as Authentificatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; //Model Eloquent

class Mahasiswa extends Model //Definisi Model
{
    protected $table="mahasiswas"; //Eloquent akan membuat model mahasiswa menyimpan 

    public $timestamps= false; 
    protected $primaryKey = 'nim'; //Memanggil isi DB dengan 
    //primaryKey
    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'nim',
        'nama',
        'kelas',
        'jurusan',
        'no_handphone',
        'email',
        'tgl_lahir'
    ];
    // use HasFactory;
};
