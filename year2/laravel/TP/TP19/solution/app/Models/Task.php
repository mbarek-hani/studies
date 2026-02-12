<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Prunable;

class Task extends Model
{
    use HasFactory, SoftDeletes, Prunable;
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'user_id'
    ];
    // Alternative : protected $guarded = ['id']; // interdit la modification massive de certains champs
    protected $attributes = [
        'status' => 'pending',
        'priority' => 1,
    ];
    protected $casts = [
        'due_date' => 'date',
        'priority' => 'integer',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Méthode pour pruning (tâches complétées depuis plus de 30 jours)
    public function prunable()
    {
        return static::where('status', 'completed')
            ->where('updated_at', '<', now()->subDays(30));
    }
    // Callback optionnel avant pruning (ex: supprimer fichiers joints si besoin)
    protected function pruning()
    {
        // Log ou actions supplémentaires
    }
}
