<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Task extends Model
{
	use HasFactory;

	protected $fillable = ['title', 'description', 'status', 'due_date', 'user_id', ];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
