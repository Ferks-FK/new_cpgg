<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
    ];

    /**
     * The attributes that should be encrypted.
     *
     * @var array
     */
    private static array $encrypted = [
        'pterodactyl_api_key',
    ];

    public function getValueAttribute($value)
    {
        if (is_null($value)) {
            return null;
        }

        if (Str::is(self::$encrypted, $this->name)) {
            try {
                return decrypt($value, false);
            } catch (DecryptException $e) {
                logger()->error($e->getMessage());
                return null;
            }
        }

        return $value;
    }

    public static function markAsEncrypted(string ...$name): void
    {
        self::$encrypted = array_merge(self::$encrypted, $name);
    }

    public function setValueAttribute($value)
    {
        if (is_null($value)) {
            $this->attributes['value'] = null;

            return;
        }

        try {
            if (Str::is(self::$encrypted, $this->name)) {
                $this->attributes['value'] = encrypt($value, false);

                return;
            }
        } catch (EncryptException $e) {
            logger()->error($e->getMessage());
            return;
        }

        $this->attributes['value'] = $value;
    }

    public static function updateSettings(string|array $key, mixed $value = null)
    {
        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $name => $val) {
            if ($val !== null) {
                self::updateOrCreate(['name' => $name], ['value' => $val]);
            } else {
                self::where('name', $name)->delete();
            }
        }

        cache()->forget('settings');
    }
}
