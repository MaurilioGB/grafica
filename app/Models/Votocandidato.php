<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Votocandidato
 * 
 * @property int $voto_id
 * @property int $candidato_id
 * @property int|null $votos
 * 
 * @property Candidato $candidato
 * @property Voto $voto
 *
 * @package App\Models
 */
class Votocandidato extends Model
{
	protected $table = 'votocandidato';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'voto_id' => 'int',
		'candidato_id' => 'int',
		'votos' => 'int'
	];

	protected $fillable = [
		'votos','voto_id', 'candidato_id'
	];

	public function candidato()
	{
		return $this->belongsTo(Candidato::class);
	}

	public function voto()
	{
		return $this->belongsTo(Voto::class);
	}
}
