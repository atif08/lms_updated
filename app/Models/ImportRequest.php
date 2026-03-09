<?php

namespace App\Models;

use App\Enums\JobStatusEnum;
use App\Enums\ReportTypeEnum;
use App\Models\SupplierSheets\SupplierSheet;
use App\Models\Tools\BugReport;
use Carbon\Carbon;
use Domain\Users\Models\User;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Class ImportRequest
 * @package App\Models
 * @property integer id
 * @property integer user_id
 * @property string report_name
 * @property string report_type
 * @property integer account_id
 * @property string importable_type
 * @property integer importable_id
 * @property string status
 * @property string file_path
 * @property integer total_rows
 * @property array headers
 * @property array mappings
 * @property string error
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property User user
 * @property User account
 * @property SupplierSheet supplier_sheet
 * @property User|Supplier importable
 */
class ImportRequest extends Model {

    protected $fillable = [
        'user_id',
        'report_name',
        'report_type',
        'account_id',
        'importable_type',
        'importable_id',
        'status',
        'file_path',
        'total_rows',
        'headers',
        'mappings',
        'error',
    ];

    protected $casts = [
        'report_type' => ReportTypeEnum::class,
        'status'      => JobStatusEnum::class,
        'headers'     => 'array',
        'mappings'    => 'array',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo {
        return $this->belongsTo(User::class, 'account_id');
    }

    /**
     * @return HasOne
     */
    public function supplier_sheet(): HasOne {
        return $this->hasOne(SupplierSheet::class);
    }

    /**
     * @return MorphTo
     */
    public function importable(): MorphTo {
        return $this->morphTo();
    }

    /**
     * @return bool
     */
    public function isPreQueued(): bool {
        return in_array($this->status, [JobStatusEnum::PENDING(), JobStatusEnum::VERIFIED()]);
    }

    /**
     * @throws Exception
     */
    public function getImporter(): string {
        $importer = config(implode('.', [
            'importers',
            $this->report_type,
            'processor'
        ]));

        if ($importer) return $importer;

        throw new Exception('Request implementation is missing');
    }

    /**
     * @throws Exception
     */
    public function getDefaultHeaders(): array {
        $headers = config(implode('.', [
            'importers',
            $this->report_type,
            'headers'
        ]));

        if ($headers) return $headers;

        throw new Exception('Request implementation is missing');
    }

    /**
     * @return array
     */
    public function getRequiredColumns(): array {
        $headers = config(implode('.', [
            'importers',
            $this->report_type,
            'headers'
        ]));

        $headers = array_filter($headers, function ($value) {
            return ($value['required'] ?? false);
        });

        return array_keys($headers);
    }

    /**
     * @throws FileNotFoundException
     */
    public function getStoragePath(): string {
        return storage()->get($this->file_path);
    }

    /**
     * @return self
     */
    public function verifyHeaders(): self {
        try {
            $storage_path = $this->getStoragePath();
            $excel_reader = IOFactory::createReaderForFile($storage_path);
            $excel = $excel_reader->load($storage_path);
            $sheet = $excel->getActiveSheet();
            $total_rows = $sheet->getHighestDataRow();

            $data_set = $sheet->toArray();
            if (empty($data_set)) {
                throw new \PhpOffice\PhpSpreadsheet\Reader\Exception('The report seems to be empty');
            }

            $this->total_rows = $total_rows;
            $this->headers = $data_set[0];
            $this->status = JobStatusEnum::VERIFIED();
            $this->save();

            if (config('filesystems.storage') == 's3') {
                unlink($storage_path);
            }

        } catch (Exception $ex) {
            BugReport::logException($ex, $this->user);
            $this->status = JobStatusEnum::FAILED();
            $this->error = $ex->getMessage();
            $this->save();
        }

        return $this;
    }
}
