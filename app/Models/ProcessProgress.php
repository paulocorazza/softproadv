<?php

namespace App\Models;

use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;

class ProcessProgress extends Model
{
    protected $table = 'process_progresses';

    protected $appends = ['date_br', 'date_term_br', 'description_limit'];

    protected $fillable = [
        'date',
        'date_term',
        'description',
        'publication',
        'concluded',
        'process_id',
        'published_at',
        'archived_at',
        'type',
        'data_hash',
        'category'
    ];

    public function rules($id = '')
    {
        return [
            'date' => 'required',
            'description' => 'required|min:3|max:120',
            'publication' => 'required',
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function scopeWithDateTerm($query)
    {
        return $query->whereNotNull('date_term');
    }


    public function scopeConcluded($query)
    {
        return $query->where('concluded', true);
    }

    public function scopePending($query)
    {
        return $query->where('concluded', false);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    public function scopeNotPublished($query)
    {
        return $query->whereNull('published_at');
    }

    public function scopeNotArchived($query)
    {
        return $query->whereNull('archived_at');
    }


    public function getDateAttribute($value)
    {
        return Helper::formatDateTime($value, 'Y-m-d');
    }


    public function getDateTermAttribute($value)
    {
        return Helper::formatDateTime($value, 'Y-m-d');
    }

    public function getDateBrAttribute()
    {
        return Helper::formatDateTime($this->date, 'd/m/Y');
    }

    public function getDateTermBrAttribute($value)
    {
      if (!empty($this->date_term)) {
          return Helper::formatDateTime($this->date_term, 'd/m/Y');
      }
    }

    public function getDescriptionLimitAttribute()
    {
        return Str::limit($this->attributes['description'], 25);
    }

    public function getDaysDiffAttribute()
    {
        $now = Carbon::now();
        $end = Carbon::parse($this->date_term);

        return $now->diffInDays($end, false);
    }

    public function getColorDaysDiffAttribute()
    {
        $days = $this->days_diff;

        return match (true) {
            $days <= 5 => 'badge-danger',
            $days <= 10 => 'badge-warning',
            default => 'badge-info',
        };
    }

    public function isIntegration()
    {
        return !isEmpty($this->data_hash);
    }
}
