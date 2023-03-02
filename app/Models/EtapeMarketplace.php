<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtapeMarketplace extends Model
{
    use HasFactory;

    protected $table = "etape_marketplace";
    protected $primaryKey = "id_etape";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_etape',
        'date_ajout',
        'date_maj',
        'id_user',
        'id_user_maj',
        'nom_etape',
        'color_etape',
        'url_etape',
        'statut',
        'sort_order'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'date_ajout',
        'date_maj',
        'id_user',
        'id_user_maj',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];
}
