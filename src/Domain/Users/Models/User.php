<?php

namespace Domain\Users\Models;

use App\Casts\SpatieEnumCast;
use App\Enums\UserTypeEnum;
use App\Models\Batch;
use Carbon\Carbon;
use Domain\Assignment\Models\Assignment;
use Domain\Assignment\Models\AssignmentExtendRequest;
use Domain\Attendance\Model\Attendance;
use Domain\Calendar\Models\CalendarEvent;
use Domain\Courses\Models\Course;
use Domain\Courses\Models\Lesson;
use Domain\Quizzes\Models\QuizAttempt;
use Domain\Users\Models\UserAttributes\HasTypeAttributes;
use Domain\Users\Models\UserAttributes\HasUserAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @property int id
 * @property string name
 * @property string email
 * @property Carbon email_verified_at
 * @property string password
 * @property bool is_active
 * @property string user_type
 * @property int parent_id
 * @property string seller_id
 * @property int marketplace_id
 * @property string region_code
 * @property string delete_status
 * @property Carbon last_activity_at
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property User parent
 * @property User[] children
 * @property User[] siblings
 * @property User[] user_accounts
 */
class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, HasRoles, HasTypeAttributes, HasUserAttributes,InteractsWithMedia,Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'mobile',
        'gender',
        'email',
        'institution',
        'major',
        'qualification_name',
        'email_verified_at',
        'password',
        'is_active',
        'user_type',
        'parent_id',
        'graduation_year',
        'national_id',
        'region_code',
        'delete_status',
        'last_activity_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => SpatieEnumCast::class.':'.UserTypeEnum::class,
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->width(150)
            ->height(150)
            ->nonQueued();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function siblings(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id', 'parent_id')
            ->where('user_type', $this->user_type)
            ->where('id', '<>', $this->id);
    }

    public function isSuperAdminUser(): bool
    {
        return $this->id === 1;
    }

    public function getParent(): User
    {
        return is_null($this->parent_id) ? $this : $this->parent;
    }

    public function getParentId(): int
    {
        return $this->parent_id ?: $this->id;
    }

    public function batch(): BelongsTo
    {

        return $this->belongsTo(Batch::class);
    }

    public function courses(): HasMany{
        return $this->hasMany(Course::class);
    }

    public function teacher_courses(): BelongsToMany
    {

        return $this->belongsToMany(Course::class);
    }

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class);
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function enrolled_courses(): BelongsToMany
    {

        return $this->belongsToMany(Course::class, 'enrollments');
    }

    public function today_attendance(): HasOne
    {
        return $this->hasOne(Attendance::class)->latest('date');
    }

    public function calendar_events(): HasMany
    {

        return $this->hasMany(CalendarEvent::class, 'user_id');
    }

    public function quiz_attempts(): MorphMany
    {
        return $this->morphMany(QuizAttempt::class, 'participant');
    }

    public function assignments(): BelongsToMany
    {
        return $this->belongsToMany(Assignment::class, 'assignment_users')->withPivot('due_date');
    }

    public function extend_requests(): HasMany
    {
        return $this->hasMany(AssignmentExtendRequest::class);
    }

    public function setPasswordAttribute($password): void
    {
        $this->attributes['password'] = Hash::needsRehash($password) ? Hash::make($password) : $password;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeStudent($query)
    {
        return $query->whereIn('user_type', [\Domain\Users\Enums\UserTypeEnum::ACCELERATED_STUDENT(), UserTypeEnum::STANDARD_STUDENT()]);
    }

    public function scopeFaculty($query)
    {
        return $query->where('user_type', UserTypeEnum::FACULTY_MEMBER());
    }
    public function scopeTeacher($query)
    {
        return $query->where('user_type', UserTypeEnum::TEACHER());
    }
}
