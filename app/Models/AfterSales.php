<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AfterSales extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_t_after_sales';
    protected $primaryKey = 'id_after_sales';
    
    protected $fillable = [
        'jenis_layanan',
        'keterangan_layanan',
        'file_pendukung_layanan',
        'id_users',
        'tgl_pengajuan',
        'status', 
        'keterangan_tindakan',
        'tgl_mulai_tindakan',
        'tgl_selesai_tindakan',
        'dok_pendukung_tindakan',
        'tim_teknis',
    ];
    
    public $timestamps = true;
    
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
    
    public function permintaanData()
    {
        return $this->hasMany(PermintaanData::class, 'id_after_sales');
    }
}