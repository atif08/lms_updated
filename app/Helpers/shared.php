<?php

use App\Helpers\StorageHelper;
use \Carbon\Carbon;
use Illuminate\Support\Str;
use Symfony\Component\VarDumper\VarDumper as Dumper;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Helper\ProgressBar;

function nap($seconds) {
    if (!$seconds) return;
    $progress = progress_bar($seconds);
    $i = 0;
    while ($i++ < $seconds) {
        $progress->advance();
        sleep(1);
    }
    print "\n";
}

function console_log() {
    if (app()->runningInConsole()) {
        print "\e[1;33m" . Carbon::now() . " : \e[0m";
        foreach (func_get_args() as $arg) {
            print_r($arg);
            print " ";
        }
        print "\n";
    } else {
        foreach (func_get_args() as $arg) {
            Log::info(print_r($arg, true));
        }
    }
}

function console_error() {
    print "\e[1;31m" . Carbon::now() . " : \e[41;97m ";
    foreach (func_get_args() as $arg) {
        print_r($arg);
        print " ";
    }
    print "\e[0m\n";
}

function log_info($message) {
    Log::info($message);
}

function log_error($message) {
    Log::error($message);
}

function progress_bar($maximum): ProgressBar {
    $output = new ConsoleOutput();
    $progress_bar = new ProgressBar($output, $maximum);
    $progress_bar->start();
    return $progress_bar;
}

function is_local(): bool {
    return (config('app.env') === 'local');
}

function is_development(): bool {
    return config('app.env') === 'development';
}

function is_production(): bool {
    return config('app.env') === 'production';
}

function dump_log() {
    array_map(function ($x) {
        (new Dumper)->dump($x);
    }, func_get_args());
}

function to_array($value) {
    return is_array($value) ? $value : explode(',', $value);
}

function is_empty($value): bool {
    return is_null($value) || $value === '';
}

function image($image_url) {
    return $image_url ?: asset('images/no-image.png');
}

function db_zero($dividend, $divisor) {
    return $divisor ? ($dividend / $divisor) : 0;
}

function required_label($label): string {
    return __($label) . ' *';
}

function is_menu_parent($menu) {
    return (isset($menu['parent']) && $menu['parent'] === 'true');
}

function get_block_id($block_name): string {
    $block_name = explode('\\', $block_name);
    return Str::snake(end($block_name));
}

function parse_date($date, $format = null): ?Carbon {
    if (!$date || $date == '0000-00-00') return NULL;

    try {
        $date = $format ? Carbon::createFromFormat($format, $date) : Carbon::parse($date);
    } catch (\Exception $ex) {
        return NULL;
    }

    if ($date->toDateString() == '1970-01-01') {
        return NULL;
    }

    return $date;
}

function clean_sku($sku) {
    return str_replace("\\", "\\\\", html_entity_decode($sku, ENT_QUOTES | ENT_HTML5));
}

function get_class_name($object) {
    $class_name = is_object($object) ? get_class($object) : $object;

    if (preg_match("@\\\\([\w]+)$@", $class_name, $matches)) {
        $class_name = $matches[1];
    }


    return $class_name;
}

function get_field_name($row, $options, $default = null) {
    foreach ($options as $option) {
        if (isset($row[$option])) {
            return $option;
        }
    }
    return $default;
}

function get_trans_headers($headers, $payload = []): array {
    $headers = array_combine($headers, $headers);

    if (!empty($payload)) {
        foreach ($payload as $key => $value) {
            if (isset($headers[$value])) {
                $headers[$value] = $key;
            }
        }
        return array_values($headers);
    }

    $translations = array_filter([
        get_field_name($headers, config('headers.sku'))                 => 'sku',
        get_field_name($headers, config('headers.product_id'))          => 'product_id',
        get_field_name($headers, config('headers.product_id_type'))     => 'product_id_type',
        get_field_name($headers, config('headers.asin'))                => 'asin',
        get_field_name($headers, config('headers.fulfillment_channel')) => 'fulfillment_channel',
        get_field_name($headers, config('headers.item_name'))           => 'item_name',
        get_field_name($headers, config('headers.item_condition'))      => 'item_condition',
        get_field_name($headers, config('headers.price'))               => 'price',
        get_field_name($headers, config('headers.status'))              => 'status',
        get_field_name($headers, config('headers.open_date'))           => 'open_date',
        get_field_name($headers, config('headers.quantity'))            => 'quantity',
    ], function ($key) {
        return !empty($key);
    }, ARRAY_FILTER_USE_KEY);

    return array_values(array_merge($headers, $translations));
}

function raw_query($query) {
    $base_query = str_replace('%', '%%', $query->toSql());
    return vsprintf(str_replace(['?'], ['\'%s\''], $base_query), $query->getBindings());
}

function storage(): StorageHelper {
    return new StorageHelper();
}

// Function to find the smallest number required to be added to M to make it divisible by N
function smallest_to_add($M, $N) {
    // find the smallest number greater than or equal to M, that is divisible by N
    $rem = ($M + $N) % $N;
    $smallest_divisible = ($rem == 0) ? $M : ($M + $N - $rem);

    // subtract M from it to get the smallest multiple of N
    return $smallest_divisible - $M;
}

function is_valid_upc(&$upc) {
    if (preg_match('/^\d{11}$/', $upc)) {
        $upc = sprintf('%012d', $upc);
    }

    // Check if the UPC is 12 digits long
    if (!preg_match('/^\d{12}$/', $upc)) {
        return false;
    }

    // Convert the UPC string to an array of integers
    $digits = array_map('intval', str_split($upc));

    // The last digit is the check digit
    $check_digit = $digits[11];

    $odd_sum = $even_sum = 0;

    // Sum odd & even positioned digits (excluding the check digit)
    for ($i = 1; $i < 12; $i++) {
        if ($i % 2 == 0) {
            $even_sum += $digits[$i - 1];
        } else {
            $odd_sum += $digits[$i - 1];
        }
    }

    // Multiply the odd sum by 3
    $odd_sum *= 3;

    // Add both sums together
    $total_sum = $odd_sum + $even_sum;

    // Finding the smallest number required to be added to $total_sum to make it divisible by 10
    $calculated_check_digit = smallest_to_add($total_sum, 10);

    // Compare the calculated check digit with the provided check digit
    return $calculated_check_digit === $check_digit;
}


function get_media_type($media)
{

    if (str_starts_with($media->mime_type, 'image/')) {
        $type = 'image';
    } elseif (str_starts_with($media->mime_type, 'application/pdf')) {
        $type = 'pdf';
    } elseif (str_starts_with($media->mime_type, 'application/vnd.ms-powerpoint')) {
        $type = 'powerpoint';
    } elseif (str_starts_with($media->mime_type, 'application/vnd.openxmlformats-officedocument.presentationml.presentation')) {
        $type = 'ppt';
    } elseif (str_starts_with($media->mime_type, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')) {
        $type = 'document';
    } elseif (Str::contains($media->mime_type, 'msword')) {
        $type = 'doc';
    } elseif (str_starts_with($media->mime_type, 'video/')) {
        $type = 'video';
    } else {
        $type = 'other';
    }

    return $type;

}

function convertGoogleDriveLink($url)
{
    if (str_contains($url, 'drive.google.com/file/d/')) {
        $url = str_replace('/view', '/preview', $url);
    }

    return $url;
}

function get_points_percentage(int $total_points, int $correct_points_sum): float|int
{
    return $total_points > 0
        ? round(($correct_points_sum / $total_points) * 100)
        : 0;
}


function convertFileToPdf(UploadedFile|string $fileOrPath): false|string
{
    // Determine input path and extension
    if ($fileOrPath instanceof UploadedFile) {
        $inputPath = $fileOrPath->getRealPath();
        $extension = strtolower($fileOrPath->getClientOriginalExtension());
    } elseif (is_string($fileOrPath) && file_exists($fileOrPath)) {
        $inputPath = $fileOrPath;
        $extension = strtolower(pathinfo($fileOrPath, PATHINFO_EXTENSION));
    } else {
        Log::error('Invalid file input provided to convertToPdf.');

        return false;
    }

    // Allowed file types
    $allowedExtensions = ['doc', 'docx', 'ppt', 'pptx'];
    if (! in_array($extension, $allowedExtensions)) {
        return false; // skip unsupported types
    }

    // Ensure output directory exists
    $outputDir = storage_path('app/converted');
    if (! is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    // Detect soffice path
    $possiblePaths = [
        '/usr/bin/soffice', // Linux
        '/usr/local/bin/soffice',
        '/Applications/LibreOffice.app/Contents/MacOS/soffice', // macOS
    ];

    $soffice = null;
    foreach ($possiblePaths as $path) {
        if (file_exists($path)) {
            $soffice = $path;
            break;
        }
    }

    if (! $soffice) {
        Log::error('LibreOffice (soffice) not found.');

        return false;
    }

    // Build and execute command
    //    $command = escapeshellcmd("$soffice --headless --convert-to pdf \"$inputPath\" --outdir \"$outputDir\"");
    $command = sprintf(
        '%s --headless --convert-to pdf %s --outdir %s',
        escapeshellcmd($soffice),
        escapeshellarg($inputPath),
        escapeshellarg($outputDir)
    );

    exec($command.' 2>&1', $output, $status);

    if ($status !== 0) {
        Log::error('PDF conversion failed.', ['output' => $output]);

        return false;
    }

    // Return the most recent PDF
    $pdfFiles = glob($outputDir.'/*.pdf');
    if (empty($pdfFiles)) {
        Log::error('PDF file not found after conversion.', ['output' => $output]);

        return false;
    }

    return collect($pdfFiles)->sortByDesc(fn ($file) => filemtime($file))->first();
}
function get_image($media): string
{

    return $media[0]?->original_url ?? \Illuminate\Support\Facades\URL::asset('images/default.jpeg');
}
