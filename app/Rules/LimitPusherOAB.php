<?php

namespace App\Rules;

use App\Models\Monitor;
use Illuminate\Contracts\Validation\Rule;

class LimitPusherOAB implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $trying = count($value);

        $limit = session('company')['plan']->oab_count_search ?? 1;

        $monitored = Monitor::oab()
            ->whereMonth('created_at', now())
            ->count();

        return $this->hasLimit($limit, $monitored, $trying);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O Limite de consultas OAB foi atingido para o mês';
    }

    /**
     * @param int $limit
     * @param int $monitored
     * @param int $trying
     * @return bool
     */
    private function hasLimit(int $limit, int $monitored, int $trying): bool
    {
        $consumed = $limit - $monitored - $trying;



        return $consumed >= 0;
    }
}
