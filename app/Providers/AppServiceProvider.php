<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Query\Builder;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Builder::macro('addSubSelect', function ($column, $query) {
            if (is_null($this->columns)) {
                $this->select($this->from.'.*');
            }
            return $this->selectSub($query, $column);
        });
        Builder::macro('orderBySub', function ($query, $direction = 'asc', $nullPosition = null) {
            if (!in_array($direction, ['asc', 'desc'])) {
                throw new Exception('Not a valid direction.');
            }
            if (!in_array($nullPosition, [null, 'first', 'last'], true)) {
                throw new Exception('Not a valid null position.');
            }
            return $this->orderByRaw(
                implode('', ['(', $query->limit(1)->toSql(), ') ', $direction, $nullPosition ? ' NULLS '.strtoupper($nullPosition) : null]),
                $query->getBindings()
            );
        });
        Builder::macro('orderBySubAsc', function ($query, $nullPosition = null) {
            return $this->orderBySub($query, 'asc', $nullPosition);
        });
        Builder::macro('orderBySubDesc', function ($query, $nullPosition = null) {
            return $this->orderBySub($query, 'desc', $nullPosition);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
