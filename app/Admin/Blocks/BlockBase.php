<?php

namespace App\Admin\Blocks;

use App\Helpers\CarbonHelper;
use Domain\Users\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlockBase
{
    const WEEKLY_DASHBOARD = 'WEEKLY_DASHBOARD';

    const MONTHLY_DASHBOARD = 'MONTHLY_DASHBOARD';

    const ASIN_DASHBOARD = 'ASIN_DASHBOARD';

    const ACCOUNTS_DASHBOARD = 'ACCOUNTS_DASHBOARD';

    /** @var User */
    protected $user;

    /** @var User */
    protected $current_account;

    protected $header = false;

    protected $export = false;

    protected $filter = false;

    /** @var CarbonHelper */
    protected $date_object;

    /** @var array */
    protected $date_range = [];

    /** @var CarbonHelper */
    protected $comp_object;

    /** @var array */
    protected $comp_range = [];

    /** @var Request */
    protected $request;

    protected $filters = [];

    public function __construct(User $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
        $this->setDateRange();
        $this->setFilters();
    }

    protected function setFilters(): void
    {
        $this->filters = $this->request->all();
    }

    protected function getUser(): User
    {
        return $this->user;
    }

    protected function setDateRange()
    {
        $this->date_object = with(new CarbonHelper($this->getUser(), $this->request));
        $this->date_range = $this->date_object->getRangeYmd();

        return $this;
    }

    protected function getDateRange(): array
    {
        return $this->date_range;
    }

    protected function getComparisonRange(): array
    {
        if (! $this->comp_range) {
            $this->comp_object = $this->date_object->getComparisonObject();
            $this->comp_range = $this->comp_object->getRangeYmd();
        }

        return $this->comp_range;
    }

    protected function getQuery()
    {
        return [];
    }

    /**
     * @return View|Factory
     */
    protected function loadHtml($data): View
    {
        return view();
    }

    protected function getHeader($data): string
    {
        return '';
    }

    public function getData(): array
    {

        $block_data = [
            'block_id' => get_block_id(get_class_name($this)),
            'date_object' => $this->date_object,
            'date_range' => $this->date_range,
            'comp_range' => $this->getComparisonRange(),
            'block_data' => $this->getQuery(),
            'callback' => 'callback'.get_class_name($this),
            'header' => $this->header,
            'filter' => $this->filter,
            'filters' => $this->filters,
        ];

        if ($view = $this->loadHtml($block_data)) {
            $block_data['html'] = $view->render();
        }

        return $block_data;
    }

    public static function getBlocks($dashboard)
    {
        return config('blocks')[strtoupper($dashboard)];
    }

    public static function getBlockIds($dashboard): array
    {
        return array_map(function ($block_name) {
            return get_block_id($block_name);
        }, array_keys(self::getBlocks($dashboard)));
    }

    public static function loadHeaderBtn()
    {
        //
    }

    // >>>>>>>>>>> EXPORT >>>>>>>>>>>
    public function getExportColumns(): array
    {
        return [];
    }

    public function getExportQuery()
    {
        return $this->getQuery();
    }

    public function formatExportValue($column, $value, $row)
    {
        $method_name = 'format'.ucfirst(str::camel($column));

        if (method_exists($this, $method_name)) {
            return $this->{$method_name}($value, $row);
        }

        return $value;
    }
}
